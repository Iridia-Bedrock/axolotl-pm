<?php

declare(strict_types=1);

namespace axolotl\entity;

use axolotl\entity\property\BoolEntityProperty;
use axolotl\entity\property\EnumEntityProperty;
use axolotl\entity\property\FloatEntityProperty;
use axolotl\entity\property\IntEntityProperty;
use pocketmine\entity\Location;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\network\mcpe\protocol\types\entity\PropertySyncData;

trait AxolotlEntityTrait{
	private PropertySyncData $propertySyncData;
	private bool $dirtyPropertySync = true;

	/**
	 * @return PropertySyncData
	 */
	public function getPropertySyncData() : PropertySyncData{
		return $this->propertySyncData;
	}

	/**
	 * @param string $propertyName
	 *
	 * @return mixed
	 */
	public function getPropertySync(string $propertyName) : mixed{
		$meta = EntityProperties::getIndex()[static::getNetworkTypeId()][$propertyName] ?? null;
		if($meta === null){
			throw new \InvalidArgumentException("Property $propertyName not found for " . static::getNetworkTypeId());
		}

		$property = EntityProperties::getEntityProperty()[static::getNetworkTypeId()][$meta] ?? null;
		if($property === null){
			throw new \InvalidArgumentException("Property mapping missing for $propertyName");
		}

		$intProps = $this->propertySyncData->getIntProperties();
		$floatProps = $this->propertySyncData->getFloatProperties();

		if($property instanceof FloatEntityProperty){
			return $floatProps[$meta] ?? $property->getDefault();
		}
		if($property instanceof EnumEntityProperty){
			return $property->getEnums()[$intProps[$meta] ?? $property->getDefault()] ?? null;
		}
		if($property instanceof BoolEntityProperty){
			return ($intProps[$meta] ?? ($property->getDefault() ? 1 : 0)) === 1;
		}

		return $intProps[$meta] ?? $property->getDefault();
	}

	/**
	 * @param string $propertyName
	 * @param mixed  $value
	 */
	/**
	 * @param string $propertyName
	 * @param mixed  $value
	 */
	public function setPropertySync(string $propertyName, mixed $value) : void{
		$meta = EntityProperties::getIndex()[static::getNetworkTypeId()][$propertyName] ?? null;
		if($meta === null){
			throw new \InvalidArgumentException("Property $propertyName not found for " . static::getNetworkTypeId());
		}

		$property = EntityProperties::getEntityProperty()[static::getNetworkTypeId()][$meta] ?? null;
		if($property === null){
			throw new \InvalidArgumentException("Property mapping missing for $propertyName");
		}

		$intProps = $this->propertySyncData->getIntProperties();
		$floatProps = $this->propertySyncData->getFloatProperties();

		if($property instanceof FloatEntityProperty){
			if(!is_numeric($value)){
				throw new \InvalidArgumentException("Property $propertyName expects a numeric value, got " . gettype($value));
			}
			$val = (float) $value;
			if($val < $property->getMin()){
				throw new \InvalidArgumentException("Value $val for $propertyName is below minimum allowed ({$property->getMin()})");
			}
			if($val > $property->getMax()){
				throw new \InvalidArgumentException("Value $val for $propertyName is above maximum allowed ({$property->getMax()})");
			}
			$floatProps[$meta] = $val;
		}else if($property instanceof IntEntityProperty){
			if(!is_int($value)){
				throw new \InvalidArgumentException("Property $propertyName expects an integer, got " . gettype($value));
			}
			if($value < $property->getMin()){
				throw new \InvalidArgumentException("Value $value for $propertyName is below minimum allowed ({$property->getMin()})");
			}
			if($value > $property->getMax()){
				throw new \InvalidArgumentException("Value $value for $propertyName is above maximum allowed ({$property->getMax()})");
			}
			$intProps[$meta] = $value;
		}elseif($property instanceof EnumEntityProperty){
			if(!is_string($value)){
				throw new \InvalidArgumentException("Property $propertyName expects a string enum, got " . gettype($value));
			}
			$enumIndex = array_search($value, $property->getEnums(), true);
			if($enumIndex === false){
				throw new \InvalidArgumentException("Invalid enum value '$value' for property $propertyName");
			}
			$intProps[$meta] = $enumIndex;

		}elseif($property instanceof BoolEntityProperty){
			if(!is_bool($value)){
				throw new \InvalidArgumentException("Property $propertyName expects a boolean, got " . gettype($value));
			}

			$intProps[$meta] = intval($value);
		}

		$this->propertySyncData = new PropertySyncData($intProps, $floatProps);
		$this->dirtyPropertySync = true;
	}

	/**
	 * @param Location         $location
	 * @param CompoundTag|null $nbt
	 *
	 * @return void
	 */
	private function axolotlConstruct(Location $location, ?CompoundTag $nbt = null) : void{
		$intProps = [];
		$floatProps = [];

		$networkId = static::getNetworkTypeId();
		$registeredProperties = EntityProperties::getEntityProperty()[$networkId] ?? [];

		foreach($registeredProperties as $meta => $property){
			if($property instanceof FloatEntityProperty){
				$floatProps[$meta] = $property->getDefault();
			}elseif($property instanceof IntEntityProperty){
				$intProps[$meta] = $property->getDefault();
			}elseif($property instanceof EnumEntityProperty){
				$intProps[$meta] = $property->getDefault();
			}elseif($property instanceof BoolEntityProperty){
				$intProps[$meta] = intval($property->getDefault());
			}
		}

		$this->propertySyncData = new PropertySyncData($intProps, $floatProps);
	}

	/**
	 * @param int $tickDiff
	 *
	 * @return bool
	 */
	protected function axolotlEntityBaseTick(int $tickDiff = 1) : bool{
		if($this->dirtyPropertySync){
			$this->sendData(null);
			$this->dirtyPropertySync = false;
		}
		return true;
	}
}