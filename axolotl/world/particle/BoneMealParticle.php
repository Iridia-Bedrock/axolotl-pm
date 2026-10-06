<?php

namespace axolotl\world\particle;

use pocketmine\math\Vector3;
use pocketmine\network\mcpe\protocol\LevelEventPacket;
use pocketmine\network\mcpe\protocol\types\LevelEvent;
use pocketmine\world\particle\Particle;

class BoneMealParticle implements Particle{
	public function __construct(){}

	public function encode(Vector3 $pos) : array{
		return [LevelEventPacket::create(LevelEvent::BONE_MEAL_USE, 0, $pos)];
	}
}
