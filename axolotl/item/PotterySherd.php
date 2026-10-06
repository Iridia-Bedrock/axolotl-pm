<?php

namespace axolotl\item;

use pocketmine\item\Item;

class PotterySherd extends Item{
	private PotterySherdType $type;

	public function getMaxStackSize() : int{
		return 1;
	}

	public function getType() : PotterySherdType{
		return $this->type;
	}

	public function setType(PotterySherdType $type) : PotterySherd{
		$this->type = $type;
		return $this;
	}
}
