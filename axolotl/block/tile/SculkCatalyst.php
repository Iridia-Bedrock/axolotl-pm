<?php

namespace axolotl\block\tile;

use pocketmine\block\tile\Spawnable;
use pocketmine\nbt\tag\CompoundTag;

class SculkCatalyst extends Spawnable{
	public const TAG_IS_MOVABLE = "isMovable";

	private bool $isMovable = false;

	public function readSaveData(CompoundTag $nbt) : void{
		$this->isMovable = (bool) $nbt->getByte(self::TAG_IS_MOVABLE, 0);
	}

	protected function writeSaveData(CompoundTag $nbt) : void{
		$nbt->setByte(self::TAG_IS_MOVABLE, (int) $this->isMovable);
	}

	protected function addAdditionalSpawnData(CompoundTag $nbt) : void{
		$nbt->setByte(self::TAG_IS_MOVABLE, (int) $this->isMovable);
	}
}
