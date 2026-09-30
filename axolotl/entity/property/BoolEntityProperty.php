<?php

namespace axolotl\entity\property;

use pocketmine\nbt\tag\CompoundTag;

class BoolEntityProperty extends EntityProperty{

	public function __construct(
		private string $propertyName,
		private bool $default = false,
		private bool $clientSync = true,
	){
	}

	/**
	 * @return string
	 */
	public function getPropertyName() : string{
		return $this->propertyName;
	}

	/**
	 * @return int|null
	 */
	public function getDefault() : ?int{
		return $this->default;
	}

	/**
	 * @return bool
	 */
	public function isClientSync() : bool{
		return $this->clientSync;
	}

	/**
	 * @return CompoundTag
	 */
	public function toNbt() : CompoundTag{
		return CompoundTag::create()
			->setString("name", $this->getPropertyName())
			->setInt("type", EntityProperty::TYPE_BOOL)
			->setInt("default", $this->getDefault())
			->setByte("clientSync", $this->isClientSync());
	}
}