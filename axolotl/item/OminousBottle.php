<?php

namespace axolotl\item;

use pocketmine\item\Potion;

class OminousBottle extends Potion{

	private const TAG_OMINOUS_BOTTLE_AMPLIFIER = "OminousBottleAmplifier";

	public function getMaxStackSize() : int{
		return 64;
	}

	public function getCooldownTicks() : int{
		return 31;
	}

	public function getAmplifier() : int{
		return $this->getNamedTag()->getInt(self::TAG_OMINOUS_BOTTLE_AMPLIFIER, 0);
	}

	public function setAmplifier(int $value) : void{
		$this->getNamedTag()->setInt(self::TAG_OMINOUS_BOTTLE_AMPLIFIER, $value);
	}
}
