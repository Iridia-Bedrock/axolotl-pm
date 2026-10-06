<?php

namespace axolotl\block;

use axolotl\world\particle\BoneMealParticle;
use pocketmine\block\Air;
use pocketmine\block\Block;
use pocketmine\block\Dirt;
use pocketmine\block\Farmland;
use pocketmine\block\Grass;
use pocketmine\block\Mycelium;
use pocketmine\block\Opaque;
use pocketmine\block\utils\DirtType;
use pocketmine\block\VanillaBlocks;
use pocketmine\item\Fertilizer;
use pocketmine\item\Item;
use pocketmine\math\Facing;
use pocketmine\math\Vector3;
use pocketmine\player\Player;

class MossBlock extends Opaque{
	public function onInteract(Item $item, int $face, Vector3 $clickVector, ?Player $player = null, array &$returnedItems = []) : bool{
		if(!$item instanceof Fertilizer || $face !== Facing::UP){
			return false;
		}

		$world = $this->position->getWorld();

		$this->convertToMoss();
		$this->populateRegion();

		$world->addParticle(
			$this->position->add(0.5, 1.5, 0.5),
			new BoneMealParticle()
		);

		$item->pop();

		return true;
	}

	protected function canConvertToMoss(Block $block) : bool{
		return $block instanceof Grass ||
			($block instanceof Dirt && $block->getDirtType() === DirtType::NORMAL) ||
			($block instanceof Dirt && $block->getDirtType() === DirtType::ROOTED) ||
			$block instanceof Mycelium;
	}

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
						$world->setBlock($pos, AxolotlBlocks::MOSS_BLOCK());
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
						$world->setBlock($pos, AxolotlBlocks::MOSS_CARPET());
					}elseif($r < 0.53125){
						$world->setBlock($pos, VanillaBlocks::FERN());
					}elseif($r < 0.575){
						$world->setBlock($pos, VanillaBlocks::AZALEA());
					}elseif($r < 0.6){
						$world->setBlock($pos, VanillaBlocks::FLOWERING_AZALEA());
					}

					break;
				}
			}
		}
	}

	protected function canBePopulated(Vector3 $pos) : bool{
		$world = $this->position->getWorld();

		$floor = $world->getBlock($pos->down());
		$block = $world->getBlock($pos);

		return $floor->isSolid() &&
			!$floor instanceof MossCarpet &&
			$block instanceof Air;
	}

	protected function canGrowPlant(Vector3 $pos) : bool{
		$block = $this->position->getWorld()->getBlock($pos->down());

		return $block instanceof Grass
			|| $block instanceof Dirt
			|| $block instanceof Farmland
			|| $block instanceof Mycelium
			|| $block instanceof MossBlock;
	}
}
