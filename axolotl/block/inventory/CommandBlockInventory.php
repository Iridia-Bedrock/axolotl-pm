<?php

namespace axolotl\block\inventory;

use pocketmine\block\inventory\BlockInventory;
use pocketmine\block\inventory\BlockInventoryTrait;
use pocketmine\inventory\SimpleInventory;
use pocketmine\world\Position;

class CommandBlockInventory extends SimpleInventory implements BlockInventory{
	use BlockInventoryTrait;

	public function __construct(Position $holder){
		$this->holder = $holder;
		parent::__construct(0);
	}
}
