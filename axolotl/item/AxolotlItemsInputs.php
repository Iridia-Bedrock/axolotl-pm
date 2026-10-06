<?php

namespace axolotl\item;

use pocketmine\block\utils\BannerPatternType;
use pocketmine\block\utils\DyeColor;
use pocketmine\block\VanillaBlocks as Blocks;
use pocketmine\item\BoatType;
use pocketmine\item\Egg;
use pocketmine\item\enchantment\ItemEnchantmentTags as EnchantmentTags;
use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier as IID;
use pocketmine\item\ItemTypeIds;
use pocketmine\item\LiquidBucket;
use pocketmine\item\StringToItemParser;
use pocketmine\utils\RegistrySource;

/**
 * @internal
 * @phpstan-extends RegistrySource<Item>
 */
class AxolotlItemsInputs extends RegistrySource{
	private static array $ids = [];
	private static array $callbacks = [];

	public function getTargetClassName() : string{
		return "AxolotlItems";
	}

	public function getTargetClassDocComment() : array{
		return [
			"Allows getting a new instance of any item implemented by axolotl-pm",
			"Every item here also has a constant of the same name in {@link ItemTypeIds} to enable items to be identified"
		];
	}

	public function cloneResults() : bool{ return true; }

	private static function makeIID(string $name) : IID{
		//this sketchy hack allows us to avoid manually writing the constants inline
		//since type IDs are generated from this class anyway, I'm OK with this hack
		//nonetheless, we should try to get rid of it in a future major version (e.g by using string type IDs)
		$reflect = new \ReflectionClass(ItemTypeIds::class);
		$typeId = $reflect->getConstant(mb_strtoupper($name));
		if(!is_int($typeId)){
			//this allows registering new stuff without adding new type ID constants
			//this reduces the number of mandatory steps to test new features in local development
			$typeId = self::$ids[mb_strtoupper($name)] ??= ItemTypeIds::newId();
		}

		return new IID($typeId);
	}

	/**
	 * @phpstan-template TItem of Item
	 * @phpstan-param \Closure(IID) : TItem $createItem
	 * @phpstan-return TItem
	 */
	protected function register(string $name, \Closure $createItem) : Item{
		$item = $createItem(self::makeIID($name));
		self::registerValue($name, $item);
		self::$callbacks[$name] = fn () => StringToItemParser::getInstance()->register($name, fn() => $item);
		return $item;
	}

	public static function delayed() : void{
		foreach (self::$callbacks as $callback) {
			$callback();
		}
	}

	protected function setup() : void{
		self::register("mace", fn(IID $id) => new Mace($id, "Mace", [EnchantmentTags::WEAPONS]));
		self::register("shield", fn(IID $id) => new Shield($id, "Shield", [EnchantmentTags::WEAPONS]));
		self::register("carrot_on_a_stick", fn(IID $id) => new CarrotOnAStick($id, "Carrot on a Stick"));
		self::register("warped_fungus_on_a_stick", fn(IID $id) => new WarpedFungusOnAStick($id, "Warped Fungus on a Stick"));
		self::register("wind_charge", fn(IID $id) => new WindCharge($id, "Wind Charge"));
		self::register("lead", fn(IID $id) => new Item($id, "Lead"));
		self::register("empty_map", fn(IID $id) => new Item($id, "Empty Map"));
		self::register("empty_locator_map", fn(IID $id) => new Item($id, "Empty Locator Map"));
		self::register("saddle", fn(IID $id) => new Item($id, "Saddle"));
		self::register("wolf_armor", fn(IID $id) => new WolfArmor($id, "Wolf Armor"));
		self::registerDelayed("elytra", fn($name) : Elytra  => new Elytra(self::makeIID($name), "Elytra"));
		self::register("brush", fn(IID $id) => new Brush($id, "Brush"));
		self::register("ominous_bottle", fn(IID $id) => new OminousBottle($id, "Ominous Bottle"));

		self::register("bundle", fn(IID $id) => new Bundle($id, "Bundle"));
		foreach (DyeColor::cases() as $c) {
			$key = strtolower($c->name);
			$display = ucfirst(strtolower($c->name));

			self::register($key . "_harness", fn(IID $id) => (new Harness($id, $display . " Harness"))->setColor($c));
			self::register($key . "_bundle", fn(IID $id) => (new Bundle($id, $display . " Bundle"))->setColor($c));
		}

		foreach ([
			"LEATHER",
			"COPPER",
			"IRON",
			"GOLDEN",
			"DIAMOND",
			"NETHERITE",
		] as $type) {
			self::register(strtolower($type) . "_horse_armor", fn(IID $id) => (new HorseArmor($id, ucfirst(strtolower($type)) . " Horse Armor")));
		}

		foreach ([
			"COPPER",
			"IRON",
			"GOLDEN",
			"DIAMOND",
			"NETHERITE",
		] as $type) {
			self::register(strtolower($type) . "_nautilus_armor", fn(IID $id) => new NautilusArmor($id, ucfirst(strtolower($type)) . " Nautilus Armor"));
		}

		self::registerDelayed("cod_bucket", fn(string $name) : LiquidBucket => new LiquidBucket(self::makeIID($name), "Bucket of Cod", Blocks::WATER()));
		self::registerDelayed("salmon_bucket", fn(string $name) : LiquidBucket => new LiquidBucket(self::makeIID($name), "Bucket of Salmon", Blocks::WATER()));
		self::registerDelayed("tropical_fish_bucket", fn(string $name) : LiquidBucket => new LiquidBucket(self::makeIID($name), "Bucket of Tropical Fish", Blocks::WATER()));
		self::registerDelayed("pufferfish_bucket", fn(string $name) : LiquidBucket => new LiquidBucket(self::makeIID($name), "Bucket of PufferFish", Blocks::WATER()));
		self::registerDelayed("axolotl_bucket", fn(string $name) : LiquidBucket => new LiquidBucket(self::makeIID($name), "Bucket of Axolotl", Blocks::WATER()));
		self::registerDelayed("tadpole_bucket", fn(string $name) : LiquidBucket => new LiquidBucket(self::makeIID($name), "Bucket of Tadpole", Blocks::WATER()));
		self::registerDelayed("powder_snow_bucket", fn(string $name) : PowerSnowBucket => new PowerSnowBucket(self::makeIID($name), "Powder Snow Bucket"));

		self::register("armor_stand", fn(IID $id) => new ArmorStand($id, "Armor Stand"));
		self::register("breeze_rod", fn(IID $id) => new Item($id, "Breeze Rod"));
		self::register("armadillo_scute", fn(IID $id) => new Item($id, "Armadillo Scute"));
		self::register("ender_eye", fn(IID $id) => new Item($id, "Ender Eye"));
		self::register("trial_key", fn(IID $id) => new Item($id, "Trial Key"));
		self::register("ominous_trial_key", fn(IID $id) => new Item($id, "Ominous Trial Key"));
		self::register("kelp", fn(IID $id) => new Kelp($id, "Kelp"));

		self::register("brown_egg", fn(IID $id) => new Egg($id, "Brown Egg"));
		self::register("blue_egg", fn(IID $id) => new Egg($id, "Blue Egg"));

		foreach(BoatType::cases() as $type){
			self::register(strtolower($type->name) . "_chest_boat", fn(IID $id) => new ChestBoat($id, $type->getDisplayName() . " Chest Boat", $type));
		}

		foreach (BannerPatternType::cases() as $pattern) {
			$key = strtolower($pattern->name);
			self::register($key . "_banner_pattern", fn(IID $id) => (new BannerPattern($id, ucfirst(strtolower($pattern->name)) . " Banner Pattern"))->setType($pattern));
		}

		foreach (PotterySherdType::cases() as $sherd) {
			$key = strtolower($sherd->name);
			self::register($key . "_pottery_sherd", fn(IID $id) => (new PotterySherd($id, ucfirst(strtolower($sherd->name)) . " Pottery Sherd"))->setType($sherd));
		}
	}
}