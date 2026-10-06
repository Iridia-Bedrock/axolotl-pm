<?php

namespace axolotl\block;

use axolotl\block\utils\VaultState;
use pocketmine\block\tile\Vault as TileVault;
use pocketmine\block\Transparent;
use pocketmine\block\utils\HorizontalFacing;
use pocketmine\block\utils\HorizontalFacingTrait;
use pocketmine\data\runtime\RuntimeDataDescriber;
use pocketmine\item\Item;
use pocketmine\math\Vector3;
use pocketmine\player\Player;

class Vault extends Transparent implements HorizontalFacing{
	use HorizontalFacingTrait;

	private bool $ominous = false;
	private VaultState $state = VaultState::INACTIVE;

	protected function describeBlockOnlyState(RuntimeDataDescriber $w) : void{
		$w->horizontalFacing($this->facing);
		$w->enum($this->state);
		$w->bool($this->ominous);
	}

	public function onInteract(Item $item, int $face, Vector3 $clickVector, ?Player $player = null, array &$returnedItems = []) : bool{
		if($player === null) return false;

		$world = $this->position->getWorld();
		$tile = $world->getTile($this->position);

		if($tile instanceof TileVault){
			return $tile->tryOpen($player, $item);
		}

		return false;
	}

	public function getState() : VaultState{
		return $this->state;
	}

	public function setState(VaultState $state) : void{
		$this->state = $state;
	}

	public function isOminous() : bool{
		return $this->ominous;
	}

	public function setOminous(bool $ominous) : void{
		$this->ominous = $ominous;
	}

	public function onScheduledUpdate() : void{
		$tile = $this->position->getWorld()->getTile($this->position);
		if ($tile instanceof TileVault) {
			$tile->onUpdate();
		}
	}
}