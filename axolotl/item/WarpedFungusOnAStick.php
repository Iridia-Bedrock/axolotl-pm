<?php

namespace axolotl\item;

use pocketmine\item\Durable;

class WarpedFungusOnAStick extends Durable{

	public function getMaxStackSize() : int{
		return 1;
	}

	public function getMaxDurability() : int{
		return 101;
	}
}