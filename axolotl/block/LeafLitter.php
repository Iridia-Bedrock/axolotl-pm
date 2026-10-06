<?php

namespace axolotl\block;

use pocketmine\block\Block;
use pocketmine\block\BlockTypeTags;
use pocketmine\block\Flowable;
use pocketmine\block\utils\Ageable;
use pocketmine\block\utils\AgeableTrait;
use pocketmine\block\utils\BlockEventHelper;
use pocketmine\block\utils\HorizontalFacing;
use pocketmine\block\utils\HorizontalFacingTrait;
use pocketmine\block\utils\StaticSupportTrait;
use pocketmine\data\runtime\RuntimeDataDescriber;
use pocketmine\item\Item;
use pocketmine\math\Facing;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\world\BlockTransaction;
use pocketmine\world\sound\BlockPlaceSound;

class LeafLitter extends Flowable implements Ageable, HorizontalFacing{
	use HorizontalFacingTrait;
	use StaticSupportTrait;
	use AgeableTrait;

	public const MAX_AGE = 7;

	protected function describeBlockOnlyState(RuntimeDataDescriber $w) : void{
		$w->facing($this->facing);
		$w->boundedIntAuto(0, 7, $this->age);
	}

	private function canBeSupportedAt(Block $block) : bool{
		$supportBlock = $block->getSide(Facing::DOWN);
		return $supportBlock->hasTypeTag(BlockTypeTags::DIRT) || $supportBlock->hasTypeTag(BlockTypeTags::MUD);
	}

	public function place(BlockTransaction $tx, Item $item, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector, ?Player $player = null) : bool{
		if ($player !== null) {
			$this->facing = Facing::opposite($player->getHorizontalFacing());
		}
		return parent::place($tx, $item, $blockReplace, $blockClicked, $face, $clickVector, $player);
	}

	public function onInteract(Item $item, int $face, Vector3 $clickVector, ?Player $player = null, array &$returnedItems = []) : bool{
		if ($item->equals($this->asItem(), false, false)) {
			if ($this->age < 3) {
				if (BlockEventHelper::grow($this, AxolotlBlocks::LEAF_LITTER()
					->setFacing($this->facing)
					->setAge($this->age + 1),
					$player
				)) {
					$item->pop();
					$this->position->getWorld()->addSound($this->position, new BlockPlaceSound($this));
					return true;
				}
			}
		}
		return false;
	}

	public function canBeReplaced() : bool{
		return true;
	}

	public function getDrops(Item $item) : array{
		return [$this->asItem()->setCount($this->getAge())];
	}
}

