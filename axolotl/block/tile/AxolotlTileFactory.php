<?php

namespace axolotl\block\tile;

use pocketmine\block\tile\Tile;
use pocketmine\block\tile\TileFactory;
use pocketmine\utils\SingletonTrait;

class AxolotlTileFactory{
	use SingletonTrait;

	public function __construct(){
		//$this->register(BeeHive::class, ["Beehive", "minecraft:beehive"]);
		$this->register(SculkSensor::class, ["CalibratedSculkSensor", "minecraft:calibrated_sculk_sensor"]);
		$this->register(CommandBlock::class, ["CommandBlock", "minecraft:command_block"]);
		$this->register(SculkCatalyst::class, ["SculkCatalyst", "minecraft:sculk_catalyst"]);
		$this->register(SculkSensor::class, ["SculkSensor", "minecraft:sculk_sensor"]);
		$this->register(SculkShrieker::class, ["SculkShrieker", "minecraft:sculk_shrieker"]);
		//$this->register(Shelf::class, ["Shelf", "minecraft:shelf"]);
		$this->register(CopperGolem::class, ["CopperGolem", "minecraft:copper_golem"]);
		$this->register(Vault::class, ["Vault", "minecraft:vault"]);
	}

	/**
	 * @param string[] $saveNames
	 * @phpstan-param class-string<Tile> $className
	 */
	public function register(string $className, array $saveNames = []) : void{
		TileFactory::getInstance()->register($className, $saveNames);
	}
}