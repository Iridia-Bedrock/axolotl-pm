<?php

namespace axolotl\block;

use pocketmine\block\Block;
use pocketmine\block\Transparent;
use pocketmine\block\utils\MultiAnyFacing;
use pocketmine\block\utils\MultiAnySupportTrait;

class SculkVein extends Transparent implements MultiAnyFacing{
	use MultiAnySupportTrait;

	/**
	 * @return int[]
	 */
	protected function getInitialPlaceFaces(Block $blockReplace) : array{
		return $blockReplace instanceof SculkVein ? $blockReplace->faces : [];
	}
}
