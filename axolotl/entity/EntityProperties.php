<?php

namespace axolotl\entity;

use axolotl\entity\property\EntityProperty;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\nbt\tag\ListTag;
use pocketmine\nbt\tag\StringTag;
use pocketmine\network\mcpe\protocol\types\CacheableNbt;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;

class EntityProperties{
	/** @var array<string, array<EntityProperty>> */
	private static array $entityProperty = [];

	/** @var array<string, array<string, int>> */
	private static array $index = [];
	/** @var array<string, CacheableNbt> */
	private static array $entityPropertyNbt = [];
	private static ?CacheableNbt $playerPropertyNbt = null;

	/**
	 * @return array
	 */
	public static function getEntityProperty() : array{
		return self::$entityProperty;
	}

	/**
	 * @return array
	 */
	public static function getIndex() : array{
		return self::$index;
	}

	/**
	 * @param string         $entityId
	 * @param EntityProperty $property
	 *
	 * @return void
	 */
	public static function register(string $entityId, EntityProperty $property) : void{
		$propertyName = $property->getPropertyName();
		if(isset(self::$index[$entityId][$propertyName])){
			throw new \InvalidArgumentException("Property '{$propertyName}' is already registered for entity '{$entityId}'.");
		}

		$properties = self::$entityProperty[$entityId] ?? [];
		$properties[] = $property;
		self::$entityProperty[$entityId] = $properties;

		$idx = count($properties) - 1;
		self::$index[$entityId][$propertyName] = $idx;

		unset(self::$entityPropertyNbt[$entityId]);
		if($entityId === EntityIds::PLAYER){
			self::$playerPropertyNbt = null;
		}
	}

	/**
	 * @return array<string, CacheableNbt>
	 */
	public static function getEntityPropertyNbt() : array{
		foreach(self::$entityProperty as $entityId => $properties){
			if(isset(self::$entityPropertyNbt[$entityId])){
				continue;
			}

			if(empty($properties)){
				continue;
			}

			$items = [];
			foreach($properties as $property){
				if (!$property->isClientSync()) continue;
				$items[] = $property->toNbt();
			}

			$nbt = CompoundTag::create()
				->setTag('properties', new ListTag($items))
				->setTag('type', new StringTag($entityId));

			self::$entityPropertyNbt[$entityId] = new CacheableNbt($nbt);
		}

		return self::$entityPropertyNbt;
	}

	/**
	 * @return CacheableNbt
	 */
	public static function getPlayerPropertyNbt() : CacheableNbt{
		if(self::$playerPropertyNbt === null){
			$properties = self::$entityProperty[EntityIds::PLAYER] ?? [];

			$items = [];
			foreach($properties as $property){
				if (!$property->isClientSync()) continue;
				$items[] = $property->toNbt();
			}

			$nbt = CompoundTag::create()
				->setTag('properties', new ListTag($items))
				->setTag('type', new StringTag(EntityIds::PLAYER));

			self::$playerPropertyNbt = new CacheableNbt($nbt);
		}
		return self::$playerPropertyNbt;
	}
}