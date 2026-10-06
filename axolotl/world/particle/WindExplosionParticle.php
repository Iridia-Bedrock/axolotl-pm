<?php

namespace axolotl\world\particle;

use pocketmine\math\Vector3;
use pocketmine\network\mcpe\protocol\LevelEventPacket;
use pocketmine\network\mcpe\protocol\types\ParticleIds;
use pocketmine\world\particle\Particle;

class WindExplosionParticle implements Particle{
	public function __construct(){}

	public function encode(Vector3 $pos) : array{
		return [LevelEventPacket::standardParticle(ParticleIds::WIND_EXPLOSION, 0, $pos)];
	}
}
