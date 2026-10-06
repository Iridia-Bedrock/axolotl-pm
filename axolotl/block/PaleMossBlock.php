<?php

namespace axolotl\block;

use pocketmine\block\Dirt;
use pocketmine\block\Farmland;
use pocketmine\block\Grass;
use pocketmine\block\Mycelium;
use pocketmine\block\VanillaBlocks;
use pocketmine\math\Vector3;

class PaleMossBlock extends MossBlock{
	protected function convertToMoss() : void{
		$world = $this->position->getWorld();

		for($x = -3; $x <= 3; $x++){
			for($z = -3; $z <= 3; $z++){
				for($y = 5; $y >= -5; $y--){

					$pos = $this->position->add($x, $y, $z);
					$block = $world->getBlock($pos);

					if(
						$this->canConvertToMoss($block) &&
						(mt_rand() / mt_getrandmax() < 0.6 ||
							(abs($x) < 3 && abs($z) < 3))
					){
						$world->setBlock($pos, AxolotlBlocks::PALE_MOSS_BLOCK());
						break;
					}
				}
			}
		}
	}

	protected function populateRegion() : void{
		$world = $this->position->getWorld();

		for($x = -3; $x <= 3; $x++){
			for($z = -3; $z <= 3; $z++){
				for($y = 5; $y >= -5; $y--){

					$pos = $this->position->add($x, $y, $z);

					if(!$this->canBePopulated($pos)){
						continue;
					}

					if(!$this->canGrowPlant($pos)){
						break;
					}

					$r = mt_rand() / mt_getrandmax();

					if($r < 0.3125){
						$world->setBlock($pos, VanillaBlocks::TALL_GRASS());
					}elseif($r < 0.46875){
						$world->setBlock($pos, AxolotlBlocks::PALE_MOSS_CARPET());
					}elseif($r < 0.53125){
						$world->setBlock($pos, VanillaBlocks::FERN());
					}

					break;
				}
			}
		}
	}

	protected function canGrowPlant(Vector3 $pos) : bool{
		$block = $this->position->getWorld()->getBlock($pos->down());

		return $block instanceof Grass
			|| $block instanceof Dirt
			|| $block instanceof Farmland
			|| $block instanceof Mycelium
			|| $block instanceof PaleMossBlock;
	}
}
