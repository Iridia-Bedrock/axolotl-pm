<?php

namespace axolotl\block;

use pocketmine\block\Stair;
use pocketmine\block\utils\Colored;
use pocketmine\block\utils\ColoredTrait;
use pocketmine\data\runtime\RuntimeDataDescriber;

class WoolStair extends Stair implements Colored{
	use ColoredTrait;

	public function getFlameEncouragement() : int{
		return 30;
	}

	public function getFlammability() : int{
		return 60;
	}
}
