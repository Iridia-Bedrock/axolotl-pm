<?php

namespace axolotl\block;

use axolotl\block\tile\CommandBlock as TileCommandBlock;
use axolotl\block\tile\CopperGolem as TileCopperGolem;
use axolotl\block\tile\SculkCatalyst as TileSculkCatalyst;
use axolotl\block\tile\SculkSensor as TileSculkSensor;
use axolotl\block\tile\SculkShrieker as TileSculkShrieker;
use axolotl\block\tile\Vault as TileVault;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo as BreakInfo;
use pocketmine\block\BlockIdentifier as BID;
use pocketmine\block\BlockTypeIds;
use pocketmine\block\BlockTypeInfo as Info;
use pocketmine\block\BlockTypeTags as Tags;
use pocketmine\block\Chest;
use pocketmine\block\Coral;
use pocketmine\block\CoralBlock;
use pocketmine\block\Flower;
use pocketmine\block\Opaque;
use pocketmine\block\tile\Chest as TileChest;
use pocketmine\block\tile\Tile;
use pocketmine\block\Transparent;
use pocketmine\item\Item;
use pocketmine\item\StringToItemParser;
use pocketmine\item\ToolTier;
use pocketmine\utils\RegistrySource;

/**
 * @internal
 * @phpstan-extends RegistrySource<Item>
 */
class AxolotlBlocksInputs extends RegistrySource{
	private static array $ids = [];

	public function getTargetClassName() : string{
		return "AxolotlBlocks";
	}

	public function getTargetClassDocComment() : array{
		return [
			"Allows getting a new instance of any block implemented by axolotl-pm",
			"Every block here also has a constant of the same name in {@link BlockTypeIds} to enable blocks to be identified"
		];
	}

	public function cloneResults() : bool{ return true; }

	/**
	 * @phpstan-param class-string<covariant Tile> $tileClass
	 */
	private static function makeBID(string $name, ?string $tileClass = null) : BID{
		//this sketchy hack allows us to avoid manually writing the constants inline
		//since type IDs are generated from this class anyway, I'm OK with this hack
		//nonetheless, we should try to get rid of it in a future major version (e.g by using string type IDs)
		$reflect = new \ReflectionClass(BlockTypeIds::class);
		$typeId = $reflect->getConstant(mb_strtoupper($name));
		if(!is_int($typeId)){
			//this allows registering new stuff without adding new type ID constants
			//this reduces the number of mandatory steps to test new features in local development
			$typeId = self::$ids[mb_strtoupper($name)] ??= BlockTypeIds::newId();
		}

		return new BID($typeId, $tileClass);
	}

	/**
	 * @phpstan-template TBlock of Block
	 * @phpstan-param \Closure(BID) : TBlock $createBlock
	 * @phpstan-param class-string<covariant Tile> $tileClass
	 * @phpstan-return TBlock
	 */
	private function register(string $name, \Closure $createBlock, ?string $tileClass = null) : void{
		self::registerDelayed($name, function($name) use ($createBlock, $tileClass) : Block {
			$block = $createBlock(self::makeBID($name, $tileClass));
			StringToItemParser::getInstance()->registerBlock($name, fn() => $block);
			return $block;
		});
	}

	public static function delayed() : void{
	}

	protected function setup() : void{
		$this->registerCommandBlocks();
		$this->registerSculks();
		$this->registerCopperChests();

		self::register("dead_tube_coral_block", fn(BID $id) => new CoralBlock($id, "Dead Tube Coral Block", new Info(BreakInfo::pickaxe(1.5, ToolTier::WOOD, 30.0))));
		self::register("dead_brain_coral_block", fn(BID $id) => new CoralBlock($id, "Dead Brain Coral Block", new Info(BreakInfo::pickaxe(1.5, ToolTier::WOOD, 30.0))));
		self::register("dead_bubble_coral_block", fn(BID $id) => new CoralBlock($id, "Dead Bubble Coral Block", new Info(BreakInfo::pickaxe(1.5, ToolTier::WOOD, 30.0))));
		self::register("dead_fire_coral_block", fn(BID $id) => new CoralBlock($id, "Dead Fire Coral Block", new Info(BreakInfo::pickaxe(1.5, ToolTier::WOOD, 30.0))));
		self::register("dead_horn_coral_block", fn(BID $id) => new CoralBlock($id, "Dead Horn Coral Block", new Info(BreakInfo::pickaxe(1.5, ToolTier::WOOD, 30.0))));
		self::register("dead_tube_coral", fn(BID $id) => new Coral($id, "Dead Tube Coral", new Info(BreakInfo::instant())));
		self::register("dead_brain_coral", fn(BID $id) => new Coral($id, "Dead Brain Coral", new Info(BreakInfo::instant())));
		self::register("dead_bubble_coral", fn(BID $id) => new Coral($id, "Dead Bubble Coral", new Info(BreakInfo::instant())));
		self::register("dead_fire_coral", fn(BID $id) => new Coral($id, "Dead Fire Coral", new Info(BreakInfo::instant())));
		self::register("dead_horn_coral", fn(BID $id) => new Coral($id, "Dead Horn Coral", new Info(BreakInfo::instant())));

		self::register("suspicious_gravel", fn(BID $id) => new SuspiciousGravel($id, "Suspicious Gravel", new Info(BreakInfo::shovel(0.25, blastResistance: 1.25))));
		self::register("suspicious_sand", fn(BID $id) => new SuspiciousSand($id, "Suspicious Sand", new Info(BreakInfo::shovel(0.25, blastResistance: 1.25))));

		self::register("golden_dandelion", fn(BID $id) => new Flower($id, "Golden Dandelion", new Info(BreakInfo::instant(), [Tags::POTTABLE_PLANTS])));
		self::register("closed_eyeblossom", fn(BID $id) => new ClosedEyeblossom($id, "Closed Eyeblossom", new Info(BreakInfo::instant())));
		self::register("open_eyeblossom", fn(BID $id) => new OpenEyeblossom($id, "Open Eyeblossom", new Info(BreakInfo::instant())));
		self::register("wildflowers", fn(BID $id) => new Flower($id, "Wildflowers", new Info(BreakInfo::instant())));
		self::register("short_dry_grass", fn(BID $id) => new ShortDryGrass($id, "Short Dry Grass", new Info(BreakInfo::instant())));
		self::register("tall_dry_grass", fn(BID $id) => new TallDryGrass($id, "Tall Dry Grass", new Info(BreakInfo::instant())));
		self::register("bush", fn(BID $id) => new Bush($id, "Bush", new Info(BreakInfo::instant())));
		self::register("leaf_litter", fn(BID $id) => new LeafLitter($id, "Leaf Litter", new Info(BreakInfo::instant())));
		self::register("seagrass", fn(BID $id) => new SeaGrass($id, "Seagrass", new Info(BreakInfo::instant())));

		self::register("honey_block", fn(BID $id) => new HoneyBlock($id, "Honey Block", new Info(BreakInfo::instant())));
		self::register("moss_block", fn(BID $id) => new MossBlock($id, "Moss", new Info(BreakInfo::shovel(0.1, blastResistance: 2.5), [Tags::DIRT])));
		self::register("moss_carpet", fn(BID $id) => new MossCarpet($id, "Moss Carpet", new Info(BreakInfo::shovel(0.1), [Tags::DIRT])));
		self::register("pale_moss_block", fn(BID $id) => new PaleMossBlock($id, "Pale Moss Block", new Info(BreakInfo::shovel(0.1, blastResistance: 2.5), [Tags::DIRT])));
		self::register("pale_moss_carpet", fn(BID $id) => new PaleMossCarpet($id, "Pale Moss Carpet", new Info(BreakInfo::shovel(0.1), [Tags::DIRT])));
		self::register("pale_hanging_moss", fn(BID $id) => new PaleHangingMoss($id, "Pale Hanging Moss", new Info(BreakInfo::instant())));

		self::register("target", fn(BID $id) => new Transparent($id, "Target", new Info(new BreakInfo(0.5))));
		self::register("turtle_egg", fn(BID $id) => new TurtleEgg($id, "Turtle Egg", new Info(BreakInfo::instant())));
		self::register("powder_snow", fn(BID $id) => new PowderSnow($id, "Powder Snow", new Info(new BreakInfo(0.25, blastResistance: 0.1))));
		self::register("scaffolding", fn(BID $id) => new Scaffolding($id, "Scaffolding", new Info(new BreakInfo(0.5, blastResistance: 0))));
		self::register("kelp_block", fn(BID $id) => new Kelp($id, "Kelp", new Info(BreakInfo::instant())));

		self::register("firefly_bush", fn(BID $id) => new FireflyBush($id, "Firefly Bush", new Info(BreakInfo::instant())));
		self::register("creaking_heart", fn(BID $id) => new CreakingHeart($id, "Creaking Heart", new Info(BreakInfo::instant())));
		self::register("beehive", fn(BID $id) => new BeeHive($id, "Beehive", new Info(BreakInfo::axe(0.6))));
		self::register("bee_nest", fn(BID $id) => new BeeNest($id, "Bee Nest", new Info(BreakInfo::axe(0.3))));
		self::register("lodestone", fn(BID $id) => new Opaque($id, "Lodestone", new Info(BreakInfo::pickaxe(2))));
		self::register("grindstone", fn(BID $id) => new Grindstone($id, "Grindstone", new Info(BreakInfo::pickaxe(2, blastResistance: 6))));
		self::register("composter", fn(BID $id) => new Composter($id, "Composter", new Info(BreakInfo::pickaxe(0.6))));
		self::register("conduit", fn(BID $id) => new Conduit($id, "Conduit", new Info(BreakInfo::pickaxe(3))));

		self::register("decorated_pot", fn(BID $id) => new DecoratedPot($id, "Decorated Pot", new Info(BreakInfo::pickaxe(1))));
		self::register("pointed_dripstone", fn(BID $id) => new PointedDripstone($id, "Pointed Dripstone", new Info(BreakInfo::pickaxe(1.5))));
		self::register("dripstone_block", fn(BID $id) => new Opaque($id, "Dripstone", new Info(BreakInfo::pickaxe(1.5))));
		self::register("trial_spawner", fn(BID $id) => new TrialSpawner($id, "Trial Spawner", new Info(BreakInfo::pickaxe(50))));
		self::register("vault", fn(BID $id) => new Vault($id, "Vault", new Info(BreakInfo::pickaxe(50))), TileVault::class);
		self::register("dried_ghast", fn(BID $id) => new DriedGhast($id, "Dried Ghast", new Info(BreakInfo::pickaxe(1))));
		self::register("sniffer_egg", fn(BID $id) => new SnifferEgg($id, "Sniffer Egg", new Info(BreakInfo::axe(1))));
		self::register("frog_spawn", fn(BID $id) => new Frogspawn($id, "Frog Spawn", new Info(BreakInfo::instant())));

		foreach([
			"copper_golem_statue" => "Copper Golem Statue",
			"exposed_copper_golem_statue" => "Exposed Copper Golem Statue",
			"weathered_copper_golem_statue" => "Weathered Copper Golem Statue",
			"oxidised_copper_golem_statue" => "Oxidised Copper Golem Statue",
			"waxed_copper_golem_statue" => "Waxed Copper Golem Statue",
			"waxed_exposed_copper_golem_statue" => "Waxed Exposed Copper Golem Statue",
			"waxed_weathered_copper_golem_statue" => "Waxed Weathered Copper Golem Statue",
			"waxed_oxidised_copper_golem_statue" => "Waxed Oxidised Copper Golem Statue",
		] as $id => $name){
			$args = [
				$id,
				fn(BID $bid) => new CopperGolem($bid, $name, new Info(BreakInfo::pickaxe(3.0))),
				TileCopperGolem::class
			];

			self::register(...$args);
		}

		/*$woolBreakInfo = new Info(new class(0.8, ToolType::SHEARS) extends BreakInfo{
			public function getBreakTime(Item $item) : float{
				$time = parent::getBreakTime($item);
				if($item->getBlockToolType() === ToolType::SHEARS){
					$time *= 3; //shears break compatible blocks 15x faster, but wool 5x
				}

				return $time;
			}
		});
		$concreteBreakInfo = new Info(BreakInfo::pickaxe(1.8, ToolTier::WOOD));

		foreach(DyeColor::cases() as $color){
			$name = $color->getDisplayName();
			$idName = fn(string $suffix) => strtolower($color->name) . "_$suffix";

			self::register($idName('wool_stairs'), fn(BID $id) => new WoolStair($id, "$name Wool Stairs", $woolBreakInfo));
			self::register($idName('wool_slab'), fn(BID $id) => new WoolSlab($id, "$name Wool Slab", $woolBreakInfo));
			self::register($idName('concrete_stairs'), fn(BID $id) => new Stair($id, "$name Concrete Stairs", $concreteBreakInfo));
			self::register($idName('concrete_slab'), fn(BID $id) => new Slab($id, "$name Concrete Slab", $concreteBreakInfo));
		}*/
	}

	private function registerCommandBlocks() : void{
		self::register("command_block", fn(BID $id) => new CommandBlock($id, "Command Block", new Info(BreakInfo::indestructible())), TileCommandBlock::class);
		self::register("chain_command_block", fn(BID $id) => new CommandBlock($id, "Chain Command Block", new Info(BreakInfo::indestructible())), TileCommandBlock::class);
		self::register("repeating_command_block", fn(BID $id) => new CommandBlock($id, "Repeating Command Block", new Info(BreakInfo::indestructible())), TileCommandBlock::class);
	}

	private function registerSculks() : void{
		self::register("sculk_catalyst", fn(BID $id) => new SculkCatalyst($id, "Sculk Catalyst", new Info(new BreakInfo(3.0, blastResistance: 3))), TileSculkCatalyst::class);
		self::register("sculk_sensor", fn(BID $id) => new SculkSensor($id, "Sculk Sensor", new Info(new BreakInfo(3.0, blastResistance: 3))), TileSculkSensor::class);
		self::register("calibrated_sculk_sensor", fn(BID $id) => new CalibratedSculkSensor($id, "Calibrated Sculk Sensor", new Info(new BreakInfo(3.0, blastResistance: 3))), TileSculkSensor::class);
		self::register("sculk_shrieker", fn(BID $id) => new SculkShrieker($id, "Sculk Shrieker", new Info(new BreakInfo(3.0, blastResistance: 3))), TileSculkShrieker::class);
		self::register("sculk_vein", fn(BID $id) => new SculkVein($id, "Sculk Vein", new Info(new BreakInfo(3.0, blastResistance: 3))));
	}

	private function registerCopperChests() : void{
		foreach([
			"copper_chest" => "Copper Chest",
			"exposed_copper_chest" => "Exposed Copper Chest",
			"weathered_copper_chest" => "Weathered Copper Chest",
			"oxidised_copper_chest" => "Oxidised Copper Chest",
			"waxed_copper_chest" => "Waxed Copper Chest",
			"waxed_exposed_copper_chest" => "Waxed Exposed Copper Chest",
			"waxed_weathered_copper_chest" => "Waxed Weathered Copper Chest",
			"waxed_oxidised_copper_chest" => "Waxed Oxidised Copper Chest",
		] as $id => $name){
			$args = [
				$id,
				fn(BID $bid) => new Chest($bid, $name, new Info(BreakInfo::pickaxe(3.0))),
				TileChest::class
			];

			self::register(...$args);
		}
	}
}