<?php

namespace axolotl\block;

use axolotl\world\sound\BucketFillPowderSnowSound;
use pocketmine\block\Block;
use pocketmine\block\BlockTypeTags;
use pocketmine\block\Flowable;
use pocketmine\block\Transparent;
use pocketmine\block\utils\StaticSupportTrait;
use pocketmine\entity\projectile\Projectile;
use pocketmine\item\Item;
use pocketmine\math\Facing;
use pocketmine\math\RayTraceResult;
use pocketmine\world\sound\CauldronEmptyPowderSnowSound;
use pocketmine\world\sound\Sound;

class RedShrub extends Flowable{
	use StaticSupportTrait;

	public function getFlameEncouragement() : int{
		return 60;
	}

	public function getFlammability() : int{
		return 100;
	}

	private function canBeSupportedAt(Block $block) : bool{
		$supportBlock = $block->getSide(Facing::DOWN);
		return
			$supportBlock->hasTypeTag(BlockTypeTags::DIRT) ||
			$supportBlock->hasTypeTag(BlockTypeTags::MUD) ||
			$supportBlock instanceof MossBlock;
	}
}