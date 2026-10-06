<?php

namespace axolotl\data\bedrock\item;

use axolotl\item\AxolotlItems as Items;
use axolotl\item\OminousBottle;
use axolotl\item\PotterySherdType;
use pocketmine\block\utils\BannerPatternType;
use pocketmine\block\utils\DyeColor;
use pocketmine\data\bedrock\item\ItemDeserializer;
use pocketmine\data\bedrock\item\ItemSerializer;
use pocketmine\data\bedrock\item\ItemSerializerDeserializerRegistrar as ItemSerializerDeserializerRegistrarPM;
use pocketmine\data\bedrock\item\ItemTypeNames as Ids;
use pocketmine\item\BoatType;

class ItemSerializerDeserializerRegistrar extends ItemSerializerDeserializerRegistrarPM{
	public function __construct(?ItemDeserializer $deserializer, ?ItemSerializer $serializer){
		parent::__construct($deserializer, $serializer);
		$this->register2to2ItemMappings();
	}

	private function register2to2ItemMappings(): void{
		$this->map1to1Item(Ids::MACE, Items::MACE());
		$this->map1to1Item(Ids::SHIELD, Items::SHIELD());
		$this->map1to1Item(Ids::CARROT_ON_A_STICK, Items::CARROT_ON_A_STICK());
		$this->map1to1Item(Ids::WARPED_FUNGUS_ON_A_STICK, Items::WARPED_FUNGUS_ON_A_STICK());
		$this->map1to1Item(Ids::WIND_CHARGE, Items::WIND_CHARGE());
		$this->map1to1Item(Ids::LEAD, Items::LEAD());
		$this->map1to1Item(Ids::EMPTY_MAP, Items::EMPTY_MAP());
		$this->map1to1Item("minecraft:empty_locator_map", Items::EMPTY_LOCATOR_MAP());
		$this->map1to1Item(Ids::SADDLE, Items::SADDLE());
		$this->map1to1Item(Ids::WOLF_ARMOR, Items::WOLF_ARMOR());
		$this->map1to1Item(Ids::ELYTRA, Items::ELYTRA());
		$this->map1to1Item(Ids::BRUSH, Items::BRUSH());

		$this->map1to1Item(Ids::BUNDLE, Items::BUNDLE());
		foreach (DyeColor::cases() as $color) {
			$key = strtolower($color->name);
			$this->map1to1Item("minecraft:" . $key . "_harness", Items::{$color->name . "_HARNESS"}());
			$this->map1to1Item("minecraft:" . $key . "_bundle", Items::{$color->name . "_BUNDLE"}());
		}

		foreach ([
			Ids::LEATHER_HORSE_ARMOR,
			Ids::COPPER_HORSE_ARMOR,
			Ids::IRON_HORSE_ARMOR,
			Ids::GOLDEN_HORSE_ARMOR,
			Ids::DIAMOND_HORSE_ARMOR,
			Ids::NETHERITE_HORSE_ARMOR,

			Ids::COPPER_NAUTILUS_ARMOR,
			Ids::IRON_NAUTILUS_ARMOR,
			Ids::GOLDEN_NAUTILUS_ARMOR,
			Ids::DIAMOND_NAUTILUS_ARMOR,
			Ids::NETHERITE_NAUTILUS_ARMOR,
		] as $id) {
			$this->map1to1Item($id, Items::{str_replace("minecraft:", "", $id)}());
		}

		$this->map1to1ItemWithMeta(
			Ids::OMINOUS_BOTTLE,
			Items::OMINOUS_BOTTLE(),
			fn(OminousBottle $item, int $meta) => $item->setAmplifier($meta),
			fn(OminousBottle $item) => $item->getAmplifier()
		);

		$this->map1to1Item(Ids::COD_BUCKET, Items::COD_BUCKET());
		$this->map1to1Item(Ids::SALMON_BUCKET, Items::SALMON_BUCKET());
		$this->map1to1Item(Ids::TROPICAL_FISH_BUCKET, Items::TROPICAL_FISH_BUCKET());
		$this->map1to1Item(Ids::PUFFERFISH_BUCKET, Items::PUFFERFISH_BUCKET());
		$this->map1to1Item(Ids::AXOLOTL_BUCKET, Items::AXOLOTL_BUCKET());
		$this->map1to1Item(Ids::TADPOLE_BUCKET, Items::TADPOLE_BUCKET());
		$this->map1to1Item(Ids::POWDER_SNOW_BUCKET, Items::POWDER_SNOW_BUCKET());

		$this->map1to1Item(Ids::ARMOR_STAND, Items::ARMOR_STAND());
		$this->map1to1Item(Ids::BREEZE_ROD, Items::BREEZE_ROD());
		$this->map1to1Item(Ids::ARMADILLO_SCUTE, Items::ARMADILLO_SCUTE());
		$this->map1to1Item(Ids::ENDER_EYE, Items::ENDER_EYE());
		$this->map1to1Item(Ids::TRIAL_KEY, Items::TRIAL_KEY());
		$this->map1to1Item(Ids::OMINOUS_TRIAL_KEY, Items::OMINOUS_TRIAL_KEY());
		$this->map1to1Item(Ids::KELP, Items::KELP());

		$this->map1to1Item(Ids::BROWN_EGG, Items::BROWN_EGG());
		$this->map1to1Item(Ids::BLUE_EGG, Items::BLUE_EGG());

		foreach(BoatType::cases() as $boat) {
			$key = strtolower($boat->name);
			$this->map1to1Item("minecraft:" . $key . "_chest_boat", Items::{$boat->name . "_CHEST_BOAT"}());
		}

		foreach (BannerPatternType::cases() as $pattern) {
			$key = strtolower($pattern->name);
			$this->map1to1Item("minecraft:" . $key . "_banner_pattern", Items::{$pattern->name . "_BANNER_PATTERN"}());
		}

		foreach (PotterySherdType::cases() as $sherd) {
			$key = strtolower($sherd->name);
			$this->map1to1Item("minecraft:" . $key . "_pottery_sherd", Items::{$sherd->name . "_POTTERY_SHERD"}());
		}
	}
}