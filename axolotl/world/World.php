<?php

declare(strict_types=1);

namespace axolotl\world;

use axolotl\meta\AxolotlPatch;
use axolotl\meta\PatchType;
use pocketmine\block\tile\Spawnable;
use pocketmine\math\Vector3;
use pocketmine\network\mcpe\convert\TypeConverter;
use pocketmine\network\mcpe\protocol\ClientboundPacket;
use pocketmine\network\mcpe\protocol\types\BlockPosition;
use pocketmine\network\mcpe\protocol\UpdateBlockPacket;
use pocketmine\world\World as WorldPM;

class World extends WorldPM{
	/**
	 * @param array $blocks
	 * @param array $mappings
	 *
	 * @return array|ClientboundPacket[]
	 */
	#[AxolotlPatch(
		type: PatchType::OVERRIDE,
		reason: "Added mappings parameter to spoof state IDs. Delegates Spawnable tiles to the parent to reduce code duplication.",
		upstreamVersion: "5.49.2"
	)]
	public function createBlockUpdatePackets(array $blocks, array $mappings = []) : array{
		if(empty($mappings)){
			return parent::createBlockUpdatePackets($blocks);
		}

		$packets = [];
		$spawnableBlocks = [];
		$blockTranslator = TypeConverter::getInstance()->getBlockTranslator();

		foreach($blocks as $b){
			if(!($b instanceof Vector3)){
				throw new \TypeError("Expected Vector3 in blocks array, got " . (is_object($b) ? get_class($b) : gettype($b)));
			}

			$tile = $this->getTileAt($b->x, $b->y, $b->z);

			if($tile instanceof Spawnable){
				$spawnableBlocks[] = $b;
				continue;
			}

			$fullBlock = $this->getBlockAt($b->x, $b->y, $b->z);
			$stateId = $fullBlock->getStateId();

			$packets[] = UpdateBlockPacket::create(
				BlockPosition::fromVector3($b),
				$blockTranslator->internalIdToNetworkId($mappings[$stateId] ?? $stateId),
				UpdateBlockPacket::FLAG_NETWORK,
				UpdateBlockPacket::DATA_LAYER_NORMAL
			);
		}

		if(!empty($spawnableBlocks)){
			$packets = array_merge($packets, parent::createBlockUpdatePackets($spawnableBlocks));
		}

		return $packets;
	}
}
