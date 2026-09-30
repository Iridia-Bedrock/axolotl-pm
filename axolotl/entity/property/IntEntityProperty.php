<?php

namespace axolotl\entity\property;

use pocketmine\nbt\tag\CompoundTag;

class IntEntityProperty extends EntityProperty{

	public function __construct(
		private string $propertyName,
		private int $min,
		private int $max,
		private ?int $default = null,
		private bool $clientSync = true,
	){
		if($this->min >= $this->max){
			throw new \InvalidArgumentException("Min value must be strictly less than max value.");
		}

		$this->default ??= $this->min;

		if($this->default < $this->min || $this->default > $this->max){
			throw new \InvalidArgumentException("Default value must be between min and max bounds.");
		}
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
	 * @return int
	 */
	public function getMin() : int{
		return $this->min;
	}

	/**
	 * @return int
	 */
	public function getMax() : int{
		return $this->max;
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
			->setInt("type", EntityProperty::TYPE_INT)
			->setInt("min", $this->getMin())
			->setInt("max", $this->getMax())
			->setInt("default", $this->getDefault())
			->setByte("clientSync", $this->isClientSync());
	}
}