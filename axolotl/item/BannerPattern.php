<?php

namespace axolotl\item;

use pocketmine\block\utils\BannerPatternType;
use pocketmine\item\Item;

class BannerPattern extends Item{
	private BannerPatternType $type;

	public function getMaxStackSize() : int{
		return 1;
	}

	public function getType() : BannerPatternType{
		return $this->type;
	}

	public function setType(BannerPatternType $type) : BannerPattern{
		$this->type = $type;
		return $this;
	}
}
