<?php

namespace axolotl\entity\property;

use pocketmine\nbt\tag\CompoundTag;

abstract class EntityProperty{
	public const TYPE_INT = 0;
	public const TYPE_FLOAT = 1;
	public const TYPE_BOOL = 2;
	public const TYPE_ENUM = 3;

	/**
	 * @return string
	 */
	public abstract function getPropertyName(): string;

	public abstract function getDefault() : mixed;

	/**
	 * @return bool
	 */
	public abstract function isClientSync() : bool;

	/**
	 * @return CompoundTag
	 */
	public abstract function toNbt(): CompoundTag;
}