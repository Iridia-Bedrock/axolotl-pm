<?php

namespace axolotl\block;

use pocketmine\block\Opaque;
use pocketmine\block\utils\FacesOppositePlacingPlayerTrait;
use pocketmine\block\utils\HorizontalFacing;
use pocketmine\data\runtime\RuntimeDataDescriber;
use pocketmine\item\Item;
use pocketmine\math\Vector3;
use pocketmine\player\Player;


class BeeHive extends Opaque implements HorizontalFacing
{
	use FacesOppositePlacingPlayerTrait {
		describeBlockOnlyState as describeFacingState;
	}

	protected int $honeyLevel = 0;

	protected function describeBlockOnlyState(RuntimeDataDescriber $w) : void
	{
		$this->describeFacingState($w);
		$w->boundedIntAuto(0, 5, $this->honeyLevel);
	}

	public function getHoneyLevel() : int
	{
		return $this->honeyLevel;
	}

	public function setHoneyLevel(int $honeyLevel) : self
	{
		$this->honeyLevel = $honeyLevel;
		return $this;
	}

	public function onInteract(Item $item, int $face, Vector3 $clickVector, ?Player $player = null, array &$returnedItems = []) : bool{
		$this->position->getWorld()->setBlock($this->position, $this->setHoneyLevel(($this->getHoneyLevel() + 1) % 6));
		return true;
	}
}
