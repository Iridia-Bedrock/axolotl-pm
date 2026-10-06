<?php

namespace axolotl\block;

use pocketmine\block\Block;
use pocketmine\block\Flowable;
use pocketmine\block\utils\StaticSupportTrait;
use pocketmine\block\Water;
use pocketmine\math\AxisAlignedBB;
use pocketmine\math\Facing;
use pocketmine\math\Vector3;

class Frogspawn extends Flowable{
	use StaticSupportTrait {
		canBePlacedAt as supportedWhenPlacedAt;
	}

	protected function recalculateCollisionBoxes() : array{
		return [AxisAlignedBB::one()->contract(1 / 16, 0, 1 / 16)->trim(Facing::UP, 63 / 64)];
	}

	public function canBePlacedAt(Block $blockReplace, Vector3 $clickVector, int $face, bool $isClickedBlock) : bool{
		return !$blockReplace instanceof Water && $this->supportedWhenPlacedAt($blockReplace, $clickVector, $face, $isClickedBlock);
	}

	private function canBeSupportedAt(Block $block) : bool{
		return $block->getSide(Facing::DOWN) instanceof Water;
	}
}