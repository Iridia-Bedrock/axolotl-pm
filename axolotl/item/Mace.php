<?php

namespace axolotl\item;

use pocketmine\item\Tool;

class Mace extends Tool{
	public function getMaxDurability() : int{
		return 501;
	}

	public function getAttackPoints() : int{
		return 5;
	}
}