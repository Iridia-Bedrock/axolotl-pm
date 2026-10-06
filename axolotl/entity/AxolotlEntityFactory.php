<?php

namespace axolotl\entity;

use axolotl\entity\projectile\WindCharge;
use pocketmine\entity\EntityDataHelper as Helper;
use pocketmine\entity\EntityFactory as EntityFactoryPM;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\utils\SingletonTrait;
use pocketmine\world\World;

class AxolotlEntityFactory{
	use SingletonTrait;

	public function __construct(){
		$this->register(WindCharge::class, function(World $world, CompoundTag $nbt) : WindCharge{
			return new WindCharge(Helper::parseLocation($nbt, $world), null, $nbt);
		}, ['WindCharge', 'minecraft:wind_charge']);
	}

	/**
	 * @param string   $className
	 * @param \Closure $creationFunc
	 * @param array    $saveNames
	 *
	 * @return void
	 */
	public function register(string $className, \Closure $creationFunc, array $saveNames) : void{
		EntityFactoryPM::getInstance()->register($className, $creationFunc, $saveNames);
	}
}