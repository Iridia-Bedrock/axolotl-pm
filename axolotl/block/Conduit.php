<?php

namespace axolotl\block;

use pocketmine\block\Transparent;

class Conduit extends Transparent {
	public function getLightLevel() : int{
		return 15;
	}
}
