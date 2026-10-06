<?php

declare(strict_types=1);

namespace axolotl\network\mcpe\cache;

use axolotl\meta\AxolotlPatch;
use axolotl\meta\PatchType;
use axolotl\network\mcpe\ChunkRequestTask;
use pocketmine\math\Vector3;
use pocketmine\network\mcpe\compression\CompressBatchPromise;
use pocketmine\network\mcpe\compression\Compressor;
use pocketmine\network\mcpe\protocol\types\DimensionIds;
use pocketmine\player\Player;
use pocketmine\world\ChunkListener;
use pocketmine\world\ChunkListenerNoOpTrait;
use pocketmine\world\format\Chunk;
use pocketmine\world\World;
use function is_string;
use function md5;
use function serialize;
use function spl_object_id;
use function strlen;

#[AxolotlPatch(
	type: PatchType::REWRITE,
	reason: "Optimized chunk caching: shares a 'default' cache for normal players, and branches to custom caches only when block spoofing is active.",
	upstreamVersion: "5.49.2"
)]
class ChunkCache implements ChunkListener{

	/** @var self[][][] */
	private static array $instances = [];

	public static function getInstance(Player $player, World $world, Compressor $compressor) : self{
		$worldId = spl_object_id($world);
		$compressorId = spl_object_id($compressor);

		$mappings = $player->getBlockMapping()->toArray();
		$mappingHash = empty($mappings) ? 'default' : md5(serialize($mappings));

		if(!isset(self::$instances[$worldId])){
			self::$instances[$worldId] = [];
			$world->addOnUnloadCallback(static function() use ($worldId) : void{
				foreach(self::$instances[$worldId] as $compressorMap){
					foreach($compressorMap as $cache){
						$cache->destroyAll();
					}
				}
				unset(self::$instances[$worldId]);
				\GlobalLogger::get()->debug("Destroyed all chunk caches for world#$worldId");
			});
		}

		if(!isset(self::$instances[$worldId][$compressorId])){
			self::$instances[$worldId][$compressorId] = [];
		}

		if(!isset(self::$instances[$worldId][$compressorId][$mappingHash])){
			\GlobalLogger::get()->debug("Created new chunk packet cache (world#$worldId, compressor#$compressorId, mapping#$mappingHash)");
			self::$instances[$worldId][$compressorId][$mappingHash] = new self($world, $compressor, $mappings);
		}

		return self::$instances[$worldId][$compressorId][$mappingHash];
	}

	public static function pruneCaches() : void{
		foreach(self::$instances as $compressorMap){
			foreach($compressorMap as $mappingMap){
				foreach($mappingMap as $chunkCache){
					foreach($chunkCache->caches as $chunkHash => $promise){
						if(is_string($promise)){
							unset($chunkCache->caches[$chunkHash]);
							$chunkCache->unregisterChunk($chunkHash);
						}
					}
				}
			}
		}
	}

	private array $caches = [];
	private array $registeredChunks = [];

	private int $hits = 0;
	private int $misses = 0;

	private function __construct(
		private World $world,
		private Compressor $compressor,
		private array $mappings = [],
		private int $dimensionId = DimensionIds::OVERWORLD
	){
	}

	private function prepareChunkAsync(int $chunkX, int $chunkZ, int $chunkHash) : CompressBatchPromise{
		$this->world->registerChunkListener($this, $chunkX, $chunkZ);
		$this->registeredChunks[$chunkHash] = [$chunkX, $chunkZ];

		$chunk = $this->world->getChunk($chunkX, $chunkZ);
		if($chunk === null){
			throw new \InvalidArgumentException("Cannot request an unloaded chunk");
		}
		++$this->misses;

		$this->world->timings->syncChunkSendPrepare->startTiming();
		try{
			$promise = new CompressBatchPromise();

			$this->world->getServer()->getAsyncPool()->submitTask(
				new ChunkRequestTask(
					$chunkX,
					$chunkZ,
					$this->dimensionId,
					$chunk,
					$promise,
					$this->compressor,
					$this->mappings
				)
			);

			$this->caches[$chunkHash] = $promise;
			$promise->onResolve(function(CompressBatchPromise $promise) use ($chunkHash) : void{
				if(($this->caches[$chunkHash] ?? null) === $promise){
					$this->caches[$chunkHash] = $promise->getResult();
				}
			});

			return $promise;
		}finally{
			$this->world->timings->syncChunkSendPrepare->stopTiming();
		}
	}

	public function request(int $chunkX, int $chunkZ) : CompressBatchPromise|string{
		$chunkHash = World::chunkHash($chunkX, $chunkZ);
		if(isset($this->caches[$chunkHash])){
			++$this->hits;
			return $this->caches[$chunkHash];
		}
		return $this->prepareChunkAsync($chunkX, $chunkZ, $chunkHash);
	}

	private function destroy(int $chunkX, int $chunkZ) : bool{
		$chunkHash = World::chunkHash($chunkX, $chunkZ);
		$existing = $this->caches[$chunkHash] ?? null;

		unset($this->caches[$chunkHash]);
		$this->unregisterChunk($chunkHash);

		return $existing !== null;
	}

	private function unregisterChunk(int $chunkHash) : void{
		if(isset($this->registeredChunks[$chunkHash])){
			[$x, $z] = $this->registeredChunks[$chunkHash];
			$this->world->unregisterChunkListener($this, $x, $z);
			unset($this->registeredChunks[$chunkHash]);
		}
	}

	public function destroyAll() : void{
		foreach($this->registeredChunks as $hash => [$x, $z]){
			$this->world->unregisterChunkListener($this, $x, $z);
		}
		$this->caches = [];
		$this->registeredChunks = [];
	}

	private function destroyOrRestart(int $chunkX, int $chunkZ) : void{
		$chunkPosHash = World::chunkHash($chunkX, $chunkZ);
		$cache = $this->caches[$chunkPosHash] ?? null;
		if($cache !== null){
			if(!is_string($cache)){
				$cache->cancel();
				unset($this->caches[$chunkPosHash]);
				$this->unregisterChunk($chunkPosHash);

				$this->prepareChunkAsync($chunkX, $chunkZ, $chunkPosHash)->onResolve(...$cache->getResolveCallbacks());
			}else{
				$this->destroy($chunkX, $chunkZ);
			}
		}
	}

	use ChunkListenerNoOpTrait {
		onChunkChanged as private;
		onBlockChanged as private;
		onChunkUnloaded as private;
	}

	public function onChunkChanged(int $chunkX, int $chunkZ, Chunk $chunk) : void{
		$this->destroyOrRestart($chunkX, $chunkZ);
	}

	public function onBlockChanged(Vector3 $block) : void{
		$this->destroy($block->getFloorX() >> Chunk::COORD_BIT_SIZE, $block->getFloorZ() >> Chunk::COORD_BIT_SIZE);
	}

	public function onChunkUnloaded(int $chunkX, int $chunkZ, Chunk $chunk) : void{
		$this->destroy($chunkX, $chunkZ);
	}

	public function calculateCacheSize() : int{
		$result = 0;
		foreach($this->caches as $cache){
			if(is_string($cache)){
				$result += strlen($cache);
			}
		}
		return $result;
	}

	public function getHitPercentage() : float{
		$total = $this->hits + $this->misses;
		return $total > 0 ? $this->hits / $total : 0.0;
	}
}