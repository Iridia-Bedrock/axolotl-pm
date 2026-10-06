<?php

namespace axolotl\block\tile;

use pocketmine\block\tile\Spawnable;
use pocketmine\nbt\tag\CompoundTag;

class SculkSensor extends Spawnable{
	public const TAG_VIBRATION_LISTENER = "VibrationListener";
	public const TAG_VIBRATION_EVENT = "event";
	public const TAG_VIBRATION_SELECTOR = "selector";
	public const TAG_IS_MOVABLE = "isMovable";

	private bool $isMovable = false;

	public function readSaveData(CompoundTag $nbt) : void{
		$this->isMovable = (bool) $nbt->getByte(self::TAG_IS_MOVABLE, 0);
	}

	protected function writeSaveData(CompoundTag $nbt) : void{
		$nbt->setTag(self::TAG_VIBRATION_LISTENER, CompoundTag::create()
			->setInt(self::TAG_VIBRATION_EVENT, 6)
			->setTag(self::TAG_VIBRATION_SELECTOR, CompoundTag::create())
		);
		$nbt->setByte(self::TAG_IS_MOVABLE, (int) $this->isMovable);
	}

	protected function addAdditionalSpawnData(CompoundTag $nbt) : void{
		$nbt->setTag(self::TAG_VIBRATION_LISTENER, CompoundTag::create()
			->setInt(self::TAG_VIBRATION_EVENT, 6)
			->setTag(self::TAG_VIBRATION_SELECTOR, CompoundTag::create())
		);
		$nbt->setByte(self::TAG_IS_MOVABLE, (int) $this->isMovable);
	}
}