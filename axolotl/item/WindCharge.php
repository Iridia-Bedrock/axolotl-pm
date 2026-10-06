<?php

namespace axolotl\item;

use axolotl\entity\projectile\WindCharge as WindChargeEntity;
use pocketmine\entity\Location;
use pocketmine\entity\projectile\Throwable;
use pocketmine\item\ProjectileItem;
use pocketmine\player\Player;

class WindCharge extends ProjectileItem{

	public function getMaxStackSize() : int{
		return 64;
	}

	protected function createEntity(Location $location, Player $thrower) : Throwable{
		return new WindChargeEntity($location, $thrower);
	}

	public function getThrowForce() : float{
		return 1.5;
	}
}
