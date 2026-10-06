<?php

namespace axolotl\block;

use pocketmine\block\MonsterSpawner;
use pocketmine\data\runtime\RuntimeDataDescriber;

class TrialSpawner extends MonsterSpawner{
	private bool $ominous = false;
	private int $state = 0;

	protected function describeBlockOnlyState(RuntimeDataDescriber $w) : void{
		$w->bool($this->ominous);
		$w->boundedIntAuto(0, 5, $this->state);
	}

	public function isOminous() : bool{
		return $this->ominous;
	}

	public function setOminous(bool $ominous) : void{
		$this->ominous = $ominous;
	}

	public function getState() : int{
		return $this->state;
	}

	public function setState(int $state) : void{
		$this->state = $state;
	}
}
