<?php

namespace axolotl\entity\property;

use pocketmine\nbt\NBT;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\nbt\tag\ListTag;
use pocketmine\nbt\tag\StringTag;

class EnumEntityProperty extends EntityProperty{

	/**
	 * @param string   $propertyName
	 * @param string[] $enums
	 * @param int|null $default
	 * @param bool     $clientSync
	 */
	public function __construct(
		private string $propertyName,
		private array $enums,
		private ?int $default = null,
		private bool $clientSync = true,
	){
		if (empty($this->enums)) {
			throw new \InvalidArgumentException("Enum entity property must contain at least one value.");
		}

		foreach ($this->enums as $value) {
			if (!is_string($value)) {
				throw new \InvalidArgumentException("Enum values must be strings.");
			}
		}

		if ($this->default === null) {
			$this->default = 0;
		}

		if (!isset($this->enums[$this->default])) {
			throw new \InvalidArgumentException("Default index '{$this->default}' does not exist in the enums array.");
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
	 * @return array
	 */
	public function getEnums() : array{
		return $this->enums;
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
		$enumTags = [];
		foreach ($this->enums as $enumValue) {
			$enumTags[] = new StringTag($enumValue);
		}

		return CompoundTag::create()
			->setString("name", $this->getPropertyName())
			->setFloat("type", EntityProperty::TYPE_ENUM ?? 0)
			->setTag("enum", new ListTag($enumTags, NBT::TAG_String))
			->setInt("default", $this->getDefault())
			->setByte("clientSync", $this->isClientSync());
	}
}