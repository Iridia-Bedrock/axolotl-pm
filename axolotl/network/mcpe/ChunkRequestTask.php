<?php

declare(strict_types=1);

namespace axolotl\network\mcpe;

use axolotl\meta\AxolotlPatch;
use axolotl\meta\PatchType;
use pmmp\encoding\ByteBufferWriter;
use pocketmine\network\mcpe\compression\CompressBatchPromise;
use pocketmine\network\mcpe\compression\Compressor;
use pocketmine\network\mcpe\convert\TypeConverter;
use pocketmine\network\mcpe\protocol\LevelChunkPacket;
use pocketmine\network\mcpe\protocol\serializer\PacketBatch;
use pocketmine\network\mcpe\protocol\types\ChunkPosition;
use pocketmine\network\mcpe\protocol\types\DimensionIds;
use pocketmine\network\mcpe\serializer\ChunkSerializer;
use pocketmine\scheduler\AsyncTask;
use pocketmine\thread\NonThreadSafeValue;
use pocketmine\world\format\Chunk;
use pocketmine\world\format\io\FastChunkSerializer;
use function chr;

class ChunkRequestTask extends AsyncTask{
	private const TLS_KEY_PROMISE = "promise";

	protected string $chunk;
	protected int $chunkX;
	protected int $chunkZ;
	/** @phpstan-var DimensionIds::* */
	private int $dimensionId;
	/** @phpstan-var NonThreadSafeValue<Compressor> */
	protected NonThreadSafeValue $compressor;
	private string $tiles;

	/** @phpstan-var NonThreadSafeValue<array<int, int>> */
	private NonThreadSafeValue $mappings;

	/**
	 * @phpstan-param DimensionIds::* $dimensionId
	 */
	#[AxolotlPatch(
		type: PatchType::INJECTION,
		reason: "Added mappings array to constructor for per-player chunk spoofing. Uses NonThreadSafeValue for thread compatibility.",
		upstreamVersion: "5.49.2"
	)]
	public function __construct(int $chunkX, int $chunkZ, int $dimensionId, Chunk $chunk, CompressBatchPromise $promise, Compressor $compressor, array $mappings = []){
		$this->compressor = new NonThreadSafeValue($compressor);

		$this->chunk = FastChunkSerializer::serializeTerrain($chunk);
		$this->chunkX = $chunkX;
		$this->chunkZ = $chunkZ;
		$this->dimensionId = $dimensionId;
		$this->tiles = ChunkSerializer::serializeTiles($chunk);

		$this->mappings = new NonThreadSafeValue($mappings);

		$this->storeLocal(self::TLS_KEY_PROMISE, $promise);
	}

	public function onRun() : void{
		$chunk = FastChunkSerializer::deserializeTerrain($this->chunk);
		$dimensionId = $this->dimensionId;

		$subCount = ChunkSerializer::getSubChunkCount($chunk, $dimensionId);
		$converter = TypeConverter::getInstance();

		$payload = ChunkSerializer::serializeFullChunk($chunk, $dimensionId, $converter->getBlockTranslator(), $this->tiles, $this->mappings->deserialize());

		$stream = new ByteBufferWriter();
		PacketBatch::encodePackets($stream, [LevelChunkPacket::create(new ChunkPosition($this->chunkX, $this->chunkZ), $dimensionId, $subCount, null, false, [], $payload)]);

		$compressor = $this->compressor->deserialize();
		$this->setResult(chr($compressor->getNetworkId()) . $compressor->compress($stream->getData()));
	}

	public function onCompletion() : void{
		/** @var CompressBatchPromise $promise */
		$promise = $this->fetchLocal(self::TLS_KEY_PROMISE);
		$promise->resolve($this->getResult());
	}
}