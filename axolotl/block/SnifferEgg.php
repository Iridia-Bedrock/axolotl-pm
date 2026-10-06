<?php

namespace axolotl\block;

use axolotl\block\utils\CrackedState;
use pocketmine\block\Transparent;
use pocketmine\data\runtime\RuntimeDataDescriber;
use pocketmine\item\Item;
use pocketmine\math\Vector3;
use pocketmine\player\Player;

class SnifferEgg extends Transparent
{
	private CrackedState $cracks = CrackedState::NO_CRACKS;

	protected function describeBlockOnlyState(RuntimeDataDescriber $w) : void
	{
		$w->enum($this->cracks);
	}

	public function getCracks() : CrackedState{
		return $this->cracks;
	}

	public function setCracks(CrackedState $cracks) : SnifferEgg{
		$this->cracks = $cracks;
		return $this;
	}

	public function onInteract(Item $item, int $face, Vector3 $clickVector, ?Player $player = null, array &$returnedItems = []) : bool{
		$this->position->getWorld()->setBlock($this->position, $this->setCracks($this->getCracks()->next()));
		return true;
	}
}
