<?php

namespace axolotl\block;

use axolotl\block\utils\Attachment;
use axolotl\block\utils\AttachmentTrait;
use pocketmine\block\Air;
use pocketmine\block\Block;
use pocketmine\block\Opaque;
use pocketmine\block\utils\FacesOppositePlacingPlayerTrait;
use pocketmine\block\utils\HorizontalFacing;
use pocketmine\block\utils\HorizontalFacingTrait;
use pocketmine\data\runtime\RuntimeDataDescriber;
use pocketmine\item\Item;
use pocketmine\math\Facing;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\world\BlockTransaction;


class Grindstone extends Opaque implements HorizontalFacing{
	use AttachmentTrait;
	use HorizontalFacingTrait;
	use FacesOppositePlacingPlayerTrait;

	protected function describeBlockOnlyState(RuntimeDataDescriber $w) : void{
		$w->horizontalFacing($this->facing);
		$this->describeAttachment($w);
	}

	public function place(BlockTransaction $tx, Item $item, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector, ?Player $player = null) : bool{
		if($player !== null){
			if (!$blockClicked instanceof Air && $blockClicked->canBeReplaced()) {
				$face = Facing::UP;
			}
			switch ($face) {
				case Facing::UP: {
					$this->facing = Facing::opposite($player->getHorizontalFacing());
					$this->setAttachment(Attachment::STANDING);
					break;
				}
				case Facing::DOWN: {
					$this->facing = Facing::opposite($player->getHorizontalFacing());
					$this->setAttachment(Attachment::HANGING);
					break;
				}
				default: {
					$this->facing = $face;
					$this->setAttachment(Attachment::SIDE);
					break;
				}
			}
		}
		return parent::place($tx, $item, $blockReplace, $blockClicked, $face, $clickVector, $player);
	}
}
