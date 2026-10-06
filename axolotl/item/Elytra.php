<?php

namespace axolotl\item;

use pocketmine\inventory\ArmorInventory;
use pocketmine\item\Armor;
use pocketmine\item\ArmorTypeInfo;
use pocketmine\item\ItemIdentifier;

class Elytra extends Armor{

	public function __construct(
		ItemIdentifier $identifier,
		string $name,
		array $enchantmentTags = []
	){ parent::__construct($identifier, $name, new ArmorTypeInfo(0, 433, ArmorInventory::SLOT_CHEST), $enchantmentTags); }
}
