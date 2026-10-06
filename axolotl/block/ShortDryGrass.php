<?php

namespace axolotl\block;

use axolotl\world\particle\BoneMealParticle;
use pocketmine\block\Flowable;
use pocketmine\item\Fertilizer;
use pocketmine\item\Item;
use pocketmine\math\Vector3;
use pocketmine\player\Player;

class ShortDryGrass extends Flowable{

	public function canBeReplaced() : bool{
		return true;
	}

	public function onInteract(Item $item, int $face, Vector3 $clickVector, ?Player $player = null, array &$returnedItems = []) : bool{
		if($item instanceof Fertilizer){
			if($player !== null && !$player->isCreative()){
				$item->pop();
			}

			$world = $this->position->getWorld();

			$world->addParticle($this->position, new BoneMealParticle());
			$world->setBlock($this->position, AxolotlBlocks::TALL_DRY_GRASS());
			return true;
		}

		return false;
	}
}
