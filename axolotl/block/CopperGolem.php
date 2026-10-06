<?php

namespace axolotl\block;

use axolotl\block\tile\CopperGolem as TileCopperGolem;
use axolotl\block\utils\CopperGolemPose;
use pocketmine\block\Transparent;
use pocketmine\block\utils\FacesOppositePlacingPlayerTrait;
use pocketmine\block\utils\HorizontalFacing;
use pocketmine\block\utils\HorizontalFacingTrait;
use pocketmine\item\Item;
use pocketmine\math\Vector3;
use pocketmine\player\Player;

class CopperGolem extends Transparent implements HorizontalFacing{
	use HorizontalFacingTrait;
	use FacesOppositePlacingPlayerTrait;

	public function onInteract(Item $item, int $face, Vector3 $clickVector, ?Player $player = null, array &$returnedItems = []) : bool{
		if ($player !== null && $item->isNull()) {
			$tile = $this->position->getWorld()->getTile($this->position);
			if ($tile instanceof TileCopperGolem) {
				$tile->setPose(match($tile->getPose()){
					CopperGolemPose::STANDING => CopperGolemPose::SITTING,
					CopperGolemPose::SITTING => CopperGolemPose::RUNNING,
					CopperGolemPose::RUNNING => CopperGolemPose::STAR,
					CopperGolemPose::STAR => CopperGolemPose::STANDING,
				});
				return true;
			}
		}
		return false;
	}
}