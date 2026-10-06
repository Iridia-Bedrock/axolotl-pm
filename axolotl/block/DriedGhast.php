<?php

namespace axolotl\block;

use pocketmine\block\Transparent;
use pocketmine\block\utils\FacesOppositePlacingPlayerTrait;
use pocketmine\block\utils\HorizontalFacing;
use pocketmine\data\runtime\RuntimeDataDescriber;
use pocketmine\item\Item;
use pocketmine\math\Vector3;
use pocketmine\player\Player;

class DriedGhast extends Transparent implements HorizontalFacing
{
	use FacesOppositePlacingPlayerTrait {
		describeBlockOnlyState as describeFacingState;
	}

	protected int $hydratationLevel = 0;

	protected function describeBlockOnlyState(RuntimeDataDescriber $w) : void
	{
		$this->describeFacingState($w);
		$w->boundedIntAuto(0, 3, $this->hydratationLevel);
	}

	public function getHydratationLevel() : int
	{
		return $this->hydratationLevel;
	}

	public function setHydratationLevel(int $hydratationLevel) : self
	{
		$this->hydratationLevel = $hydratationLevel;
		return $this;
	}

	public function onInteract(Item $item, int $face, Vector3 $clickVector, ?Player $player = null, array &$returnedItems = []) : bool{
		$this->position->getWorld()->setBlock($this->position, $this->setHydratationLevel(($this->getHydratationLevel() + 1) % 3));
		return true;
	}
}
