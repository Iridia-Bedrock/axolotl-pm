<?php

namespace axolotl\item;

use pocketmine\nbt\tag\ByteTag;
use pocketmine\nbt\tag\CompoundTag;

trait AxolotlItemTrait{
	private const TAG_ITEM_LOCK = "minecraft:item_lock"; //TAG_Byte

	private ItemLockMode $lockMode = ItemLockMode::NONE;

	/**
	 * @return ItemLockMode
	 */
	public function getLockMode() : ItemLockMode{
		return $this->lockMode;
	}

	/**
	 * @param ItemLockMode $lockMode
	 */
	public function setLockMode(ItemLockMode $lockMode) : void{
		$this->lockMode = $lockMode;
	}

	protected function axolotlDeserializeCompoundTag(CompoundTag $tag) : void{
		if(($lockValue = $tag->getTag(self::TAG_ITEM_LOCK)) instanceof ByteTag){
			$this->lockMode = ItemLockMode::tryFrom($lockValue->getValue()) ?? ItemLockMode::NONE;
		}else{
			$this->lockMode = ItemLockMode::NONE;
		}
	}

	protected function axolotlSerializeCompoundTag(CompoundTag $tag) : void{
		if ($this->lockMode !== ItemLockMode::NONE) {
			$tag->setByte(self::TAG_ITEM_LOCK, $this->lockMode->value);
		} else {
			$tag->removeTag(self::TAG_ITEM_LOCK);
		}
	}
}