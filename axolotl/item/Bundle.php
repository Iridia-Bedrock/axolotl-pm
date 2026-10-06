<?php

namespace axolotl\item;

use pocketmine\block\utils\DyeColor;
use pocketmine\item\Item;

class Bundle extends Item{
	private DyeColor $color = DyeColor::BLACK;

	public function getColor() : DyeColor{
		return $this->color;
	}

	/**
	 * @return $this
	 */
	public function setColor(DyeColor $color) : self{
		$this->color = $color;
		return $this;
	}

	public function getMaxStackSize() : int{
		return 1;
	}
}
