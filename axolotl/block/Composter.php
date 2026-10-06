<?php

namespace axolotl\block;

use pocketmine\block\Transparent;
use pocketmine\data\runtime\RuntimeDataDescriber;
use pocketmine\item\Item;
use pocketmine\math\Vector3;
use pocketmine\player\Player;


class Composter extends Transparent{

	private int $fillLevel = 0;

	protected function describeBlockOnlyState(RuntimeDataDescriber $w) : void{
		$w->boundedIntAuto(0, 8, $this->fillLevel);
	}

	public function getFillLevel() : int{
		return $this->fillLevel;
	}

	public function setFillLevel(int $fillLevel) : void{
		$this->fillLevel = $fillLevel;
	}

	public function onInteract(Item $item, int $face, Vector3 $clickVector, ?Player $player = null, array &$returnedItems = []) : bool{
		$this->fillLevel = ($this->fillLevel + 1) % 8;
		return false;
	}
}
