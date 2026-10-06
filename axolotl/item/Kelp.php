<?php

namespace axolotl\item;

use axolotl\block\AxolotlBlocks;
use pocketmine\block\Block;
use pocketmine\item\Item;

class Kelp extends Item{
	public function getBlock(?int $clickedFace = null) : Block{
		return AxolotlBlocks::KELP_BLOCK();
	}
}
