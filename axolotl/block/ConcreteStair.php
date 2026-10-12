<?php

namespace axolotl\block;

use pocketmine\block\Stair;
use pocketmine\block\utils\Colored;
use pocketmine\block\utils\ColoredTrait;
use pocketmine\data\runtime\RuntimeDataDescriber;

class ConcreteStair extends Stair implements Colored{
	use ColoredTrait;
}
