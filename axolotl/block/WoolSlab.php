<?php

namespace axolotl\block;

use pocketmine\block\Slab;
use pocketmine\block\utils\Colored;
use pocketmine\block\utils\ColoredTrait;
use pocketmine\data\runtime\RuntimeDataDescriber;


class WoolSlab extends Slab implements Colored{
	use ColoredTrait;

	public function getFlameEncouragement() : int{
		return 30;
	}

	public function getFlammability() : int{
		return 60;
	}

}
