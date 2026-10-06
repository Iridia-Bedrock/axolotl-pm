<?php

namespace axolotl\item;

use pocketmine\item\Durable;

class CarrotOnAStick extends Durable{

	public function getMaxStackSize() : int{
		return 1;
	}

	public function getMaxDurability() : int{
		return 26;
	}
}
