<?php

namespace axolotl\block;

use axolotl\world\World;
use pocketmine\block\Flower;
use pocketmine\block\utils\BlockEventHelper;

class ClosedEyeblossom extends Flower{

	public function ticksRandomly() : bool{
		return true;
	}

	public function onRandomTick() : void{
		$world = $this->position->getWorld();

		if($world->getTimeOfDay() < World::TIME_NIGHT){
			BlockEventHelper::grow($this, AxolotlBlocks::CLOSED_EYEBLOSSOM(), null);
			$this->rescheduleNearby();
		}
	}

	private function rescheduleNearby() : void{
		$world = $this->position->getWorld();

		for($x = -3; $x <= 3; $x++){
			for($y = -2; $y <= 2; $y++){
				for($z = -3; $z <= 3; $z++){

					$pos = $this->position->add($x, $y, $z);
					$block = $world->getBlock($pos);

					if($block instanceof ClosedEyeblossom || $block instanceof OpenEyeblossom){
						$world->scheduleDelayedBlockUpdate($pos, 1);
					}
				}
			}
		}
	}
}
