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
use pocketmine\block\BlockToolType as ToolType;
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
	 * @phpstan-param class-string<covariant Tile>|null $tileClass
	 */
	private function register(string $name, \Closure $createBlock, ?string $tileClass = null) : void{
		$type = (new \ReflectionFunction($createBlock))->getReturnType()?->getName() ?? Block::class;

		self::registerDelayed($name, eval("return function (string \$name) use(\$createBlock, \$tileClass) : $type {
			\$block = \$createBlock(self::makeBID(\$name, \$tileClass));
			\pocketmine\item\StringToItemParser::getInstance()->registerBlock(\$name, fn() => \$block);

			return \$block;
		};"));
	}

	public static function delayed() : void{
	}

	protected function setup() : void{
		$this->registerCommandBlocks();
		$this->registerSculks();
		$this->registerCopperChests();

		self::register("dead_tube_coral_block", fn(BID $id): CoralBlock => new CoralBlock($id, "Dead Tube Coral Block", new Info(BreakInfo::pickaxe(1.5, ToolTier::WOOD, 30.0))));
		self::register("dead_brain_coral_block", fn(BID $id): CoralBlock => new CoralBlock($id, "Dead Brain Coral Block", new Info(BreakInfo::pickaxe(1.5, ToolTier::WOOD, 30.0))));
		self::register("dead_bubble_coral_block", fn(BID $id): CoralBlock => new CoralBlock($id, "Dead Bubble Coral Block", new Info(BreakInfo::pickaxe(1.5, ToolTier::WOOD, 30.0))));
		self::register("dead_fire_coral_block", fn(BID $id): CoralBlock => new CoralBlock($id, "Dead Fire Coral Block", new Info(BreakInfo::pickaxe(1.5, ToolTier::WOOD, 30.0))));
		self::register("dead_horn_coral_block", fn(BID $id): CoralBlock => new CoralBlock($id, "Dead Horn Coral Block", new Info(BreakInfo::pickaxe(1.5, ToolTier::WOOD, 30.0))));
		self::register("dead_tube_coral", fn(BID $id): Coral => new Coral($id, "Dead Tube Coral", new Info(BreakInfo::instant())));
		self::register("dead_brain_coral", fn(BID $id): Coral => new Coral($id, "Dead Brain Coral", new Info(BreakInfo::instant())));
		self::register("dead_bubble_coral", fn(BID $id): Coral => new Coral($id, "Dead Bubble Coral", new Info(BreakInfo::instant())));
		self::register("dead_fire_coral", fn(BID $id): Coral => new Coral($id, "Dead Fire Coral", new Info(BreakInfo::instant())));
		self::register("dead_horn_coral", fn(BID $id): Coral => new Coral($id, "Dead Horn Coral", new Info(BreakInfo::instant())));

		self::register("suspicious_gravel", fn(BID $id): SuspiciousGravel => new SuspiciousGravel($id, "Suspicious Gravel", new Info(BreakInfo::shovel(0.25, blastResistance: 1.25))));
		self::register("suspicious_sand", fn(BID $id): SuspiciousSand => new SuspiciousSand($id, "Suspicious Sand", new Info(BreakInfo::shovel(0.25, blastResistance: 1.25))));

		self::register("golden_dandelion", fn(BID $id): Flower => new Flower($id, "Golden Dandelion", new Info(BreakInfo::instant(), [Tags::POTTABLE_PLANTS])));
		self::register("closed_eyeblossom", fn(BID $id): ClosedEyeblossom => new ClosedEyeblossom($id, "Closed Eyeblossom", new Info(BreakInfo::instant())));
		self::register("open_eyeblossom", fn(BID $id): OpenEyeblossom => new OpenEyeblossom($id, "Open Eyeblossom", new Info(BreakInfo::instant())));
		self::register("wildflowers", fn(BID $id): Flower => new Flower($id, "Wildflowers", new Info(BreakInfo::instant())));
		self::register("short_dry_grass", fn(BID $id): ShortDryGrass => new ShortDryGrass($id, "Short Dry Grass", new Info(BreakInfo::instant())));
		self::register("tall_dry_grass", fn(BID $id): TallDryGrass => new TallDryGrass($id, "Tall Dry Grass", new Info(BreakInfo::instant())));
		self::register("bush", fn(BID $id): Bush => new Bush($id, "Bush", new Info(BreakInfo::instant())));
		self::register("leaf_litter", fn(BID $id): LeafLitter => new LeafLitter($id, "Leaf Litter", new Info(BreakInfo::instant())));
		self::register("seagrass", fn(BID $id): SeaGrass => new SeaGrass($id, "Seagrass", new Info(BreakInfo::instant())));

		self::register("honey_block", fn(BID $id): HoneyBlock => new HoneyBlock($id, "Honey Block", new Info(BreakInfo::instant())));
		self::register("moss_block", fn(BID $id): MossBlock => new MossBlock($id, "Moss", new Info(BreakInfo::shovel(0.1, blastResistance: 2.5), [Tags::DIRT])));
		self::register("moss_carpet", fn(BID $id): MossCarpet => new MossCarpet($id, "Moss Carpet", new Info(BreakInfo::shovel(0.1), [Tags::DIRT])));
		self::register("pale_moss_block", fn(BID $id): PaleMossBlock => new PaleMossBlock($id, "Pale Moss Block", new Info(BreakInfo::shovel(0.1, blastResistance: 2.5), [Tags::DIRT])));
		self::register("pale_moss_carpet", fn(BID $id): PaleMossCarpet => new PaleMossCarpet($id, "Pale Moss Carpet", new Info(BreakInfo::shovel(0.1), [Tags::DIRT])));
		self::register("pale_hanging_moss", fn(BID $id): PaleHangingMoss => new PaleHangingMoss($id, "Pale Hanging Moss", new Info(BreakInfo::instant())));

		self::register("target", fn(BID $id): Transparent => new Transparent($id, "Target", new Info(new BreakInfo(0.5))));
		self::register("turtle_egg", fn(BID $id): TurtleEgg => new TurtleEgg($id, "Turtle Egg", new Info(BreakInfo::instant())));
		self::register("powder_snow", fn(BID $id): PowderSnow => new PowderSnow($id, "Powder Snow", new Info(new BreakInfo(0.25, blastResistance: 0.1))));
		self::register("scaffolding", fn(BID $id): Scaffolding => new Scaffolding($id, "Scaffolding", new Info(new BreakInfo(0.5, blastResistance: 0))));
		self::register("kelp_block", fn(BID $id): Kelp => new Kelp($id, "Kelp", new Info(BreakInfo::instant())));

		self::register("firefly_bush", fn(BID $id): FireflyBush => new FireflyBush($id, "Firefly Bush", new Info(BreakInfo::instant())));
		self::register("creaking_heart", fn(BID $id): CreakingHeart => new CreakingHeart($id, "Creaking Heart", new Info(BreakInfo::instant())));
		self::register("beehive", fn(BID $id): BeeHive => new BeeHive($id, "Beehive", new Info(BreakInfo::axe(0.6))));
		self::register("bee_nest", fn(BID $id): BeeNest => new BeeNest($id, "Bee Nest", new Info(BreakInfo::axe(0.3))));
		self::register("lodestone", fn(BID $id): Opaque => new Opaque($id, "Lodestone", new Info(BreakInfo::pickaxe(2))));
		self::register("grindstone", fn(BID $id): Grindstone => new Grindstone($id, "Grindstone", new Info(BreakInfo::pickaxe(2, blastResistance: 6))));
		self::register("composter", fn(BID $id): Composter => new Composter($id, "Composter", new Info(BreakInfo::pickaxe(0.6))));
		self::register("conduit", fn(BID $id): Conduit => new Conduit($id, "Conduit", new Info(BreakInfo::pickaxe(3))));

		self::register("decorated_pot", fn(BID $id): DecoratedPot => new DecoratedPot($id, "Decorated Pot", new Info(BreakInfo::pickaxe(1))));
		self::register("pointed_dripstone", fn(BID $id): PointedDripstone => new PointedDripstone($id, "Pointed Dripstone", new Info(BreakInfo::pickaxe(1.5))));
		self::register("dripstone_block", fn(BID $id): Opaque => new Opaque($id, "Dripstone", new Info(BreakInfo::pickaxe(1.5))));
		self::register("trial_spawner", fn(BID $id): TrialSpawner => new TrialSpawner($id, "Trial Spawner", new Info(BreakInfo::pickaxe(50))));
		self::register("vault", fn(BID $id): Vault => new Vault($id, "Vault", new Info(BreakInfo::pickaxe(50))), TileVault::class);
		self::register("dried_ghast", fn(BID $id): DriedGhast => new DriedGhast($id, "Dried Ghast", new Info(BreakInfo::pickaxe(1))));
		self::register("sniffer_egg", fn(BID $id): SnifferEgg => new SnifferEgg($id, "Sniffer Egg", new Info(BreakInfo::axe(1))));
		self::register("frog_spawn", fn(BID $id): Frogspawn => new Frogspawn($id, "Frog Spawn", new Info(BreakInfo::instant())));
		self::register("red_shrub", fn(BID $id): RedShrub => new RedShrub($id, "Red Shrub", new Info(BreakInfo::instant())));

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
				fn(BID $bid): CopperGolem => new CopperGolem($bid, $name, new Info(BreakInfo::pickaxe(3.0))),
				TileCopperGolem::class
			];

			self::register(...$args);
		}

		$woolBreakInfo = new Info(new class(0.8, ToolType::SHEARS) extends BreakInfo{
			public function getBreakTime(Item $item) : float{
				$time = parent::getBreakTime($item);
				if($item->getBlockToolType() === ToolType::SHEARS){
					$time *= 3; //shears break compatible blocks 15x faster, but wool 5x
				}

				return $time;
			}
		});
		self::register("wool_slab", fn (BID $id): WoolSlab => new WoolSlab($id, "Wool Slab", $woolBreakInfo));
		self::register("wool_stairs", fn (BID $id): WoolStair => new WoolStair($id, "Wool Stair", $woolBreakInfo));

		$concreteBreakInfo = new Info(BreakInfo::pickaxe(1.8, ToolTier::WOOD));
		self::register("concrete_slab", fn (BID $id): ConcreteSlab => new ConcreteSlab($id, "Concrete Slab", $concreteBreakInfo));
		self::register("concrete_stairs", fn (BID $id): ConcreteStair => new ConcreteStair($id, "Concrete Stairs", $concreteBreakInfo));
	}

	private function registerCommandBlocks() : void{
		self::register("command_block", fn(BID $id): CommandBlock => new CommandBlock($id, "Command Block", new Info(BreakInfo::indestructible())), TileCommandBlock::class);
		self::register("chain_command_block", fn(BID $id): CommandBlock => new CommandBlock($id, "Chain Command Block", new Info(BreakInfo::indestructible())), TileCommandBlock::class);
		self::register("repeating_command_block", fn(BID $id): CommandBlock => new CommandBlock($id, "Repeating Command Block", new Info(BreakInfo::indestructible())), TileCommandBlock::class);
	}

	private function registerSculks() : void{
		self::register("sculk_catalyst", fn(BID $id): SculkCatalyst => new SculkCatalyst($id, "Sculk Catalyst", new Info(new BreakInfo(3.0, blastResistance: 3))), TileSculkCatalyst::class);
		self::register("sculk_sensor", fn(BID $id): SculkSensor => new SculkSensor($id, "Sculk Sensor", new Info(new BreakInfo(3.0, blastResistance: 3))), TileSculkSensor::class);
		self::register("calibrated_sculk_sensor", fn(BID $id): CalibratedSculkSensor => new CalibratedSculkSensor($id, "Calibrated Sculk Sensor", new Info(new BreakInfo(3.0, blastResistance: 3))), TileSculkSensor::class);
		self::register("sculk_shrieker", fn(BID $id): SculkShrieker => new SculkShrieker($id, "Sculk Shrieker", new Info(new BreakInfo(3.0, blastResistance: 3))), TileSculkShrieker::class);
		self::register("sculk_vein", fn(BID $id): SculkVein => new SculkVein($id, "Sculk Vein", new Info(new BreakInfo(3.0, blastResistance: 3))));
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
				fn(BID $bid): Chest => new Chest($bid, $name, new Info(BreakInfo::pickaxe(3.0))),
				TileChest::class
			];

			self::register(...$args);
		}
	}
}