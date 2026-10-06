<?php

namespace axolotl\block\tile;

use axolotl\block\utils\CopperGolemPose;
use pocketmine\block\tile\Spawnable;
use pocketmine\nbt\tag\CompoundTag;

class CopperGolem extends Spawnable{
	public const TAG_IS_MOVABLE = "isMovable";
	public const TAG_POSE = "Pose";

	private CopperGolemPose $pose = CopperGolemPose::STANDING;
	private bool $isMovable = false;

	public function getPose() : CopperGolemPose{
		return $this->pose;
	}

	public function setPose(CopperGolemPose $pose) : void{
		$this->pose = $pose;
		$this->setDirty();
	}

	public function isMovable() : bool{
		return $this->isMovable;
	}

	public function setIsMovable(bool $isMovable) : void{
		$this->isMovable = $isMovable;
		$this->setDirty();
	}

	public function readSaveData(CompoundTag $nbt) : void{
		$this->pose = CopperGolemPose::from($nbt->getInt(self::TAG_POSE, 0));
		$this->isMovable = (bool) $nbt->getByte(self::TAG_IS_MOVABLE, 0);
	}

	protected function writeSaveData(CompoundTag $nbt) : void{
		$nbt->setInt(self::TAG_POSE, $this->pose->value);
		$nbt->setByte(self::TAG_IS_MOVABLE, (int) $this->isMovable);
	}

	protected function addAdditionalSpawnData(CompoundTag $nbt) : void{
		$nbt->setInt(self::TAG_POSE, $this->pose->value);
		$nbt->setByte(self::TAG_IS_MOVABLE, (int) $this->isMovable);
	}
}
