<?php

namespace axolotl\entity\property;

use pocketmine\nbt\tag\CompoundTag;

class FloatEntityProperty extends EntityProperty{

	public function __construct(
		private string $propertyName,
		private float $min,
		private float $max,
		private ?float $default = null,
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
	 * @return float|null
	 */
	public function getDefault() : ?float{
		return $this->default;
	}

	/**
	 * @return float
	 */
	public function getMin() : float{
		return $this->min;
	}

	/**
	 * @return float
	 */
	public function getMax() : float{
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
			->setFloat("type", EntityProperty::TYPE_FLOAT)
			->setFloat("min", $this->getMin())
			->setFloat("max", $this->getMax())
			->setFloat("default", $this->getDefault())
			->setByte("clientSync", $this->isClientSync());
	}
}