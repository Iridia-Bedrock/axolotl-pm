<?php

namespace axolotl\block\utils;

use pocketmine\data\runtime\RuntimeDataDescriber;

trait BrushableTrait{
	private bool $hanging = false;
	private int $progress = 0;

	public function isHanging() : bool{
		return $this->hanging;
	}

	public function setHanging(bool $hanging) : void{
		$this->hanging = $hanging;
	}

	public function getProgress() : int{
		return $this->progress;
	}

	public function setProgress(int $progress) : void{
		$this->progress = $progress;
	}

	protected function describeBlockOnlyState(RuntimeDataDescriber $w) : void
	{
		$w->bool($this->hanging);
		$w->boundedIntAuto(0, 3, $this->progress);
	}
}
