<?php

/*
 *
 *  ____            _        _   __  __ _                  __  __ ____
 * |  _ \ ___   ___| | _____| |_|  \/  (_)_ __   ___      |  \/  |  _ \
 * | |_) / _ \ / __| |/ / _ \ __| |\/| | | '_ \ / _ \_____| |\/| | |_) |
 * |  __/ (_) | (__|   <  __/ |_| |  | | | | | |  __/_____| |  | |  __/
 * |_|   \___/ \___|_|\_\___|\__|_|  |_|_|_| |_|\___|     |_|  |_|_|
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author PocketMine Team
 * @link http://www.pocketmine.net/
 *
 *
 */

declare(strict_types=1);

namespace axolotl\block;

use pocketmine\block\Block;
use pocketmine\block\Chest;
use pocketmine\block\Coral;
use pocketmine\block\CoralBlock;
use pocketmine\block\Flower;
use pocketmine\block\Opaque;
use pocketmine\block\Transparent;
use pocketmine\utils\Utils;
use function array_keys;
use function count;
use function implode;
use function mb_strtoupper;

/**
 * Allows getting a new instance of any block implemented by axolotl-pm
 * Every block here also has a constant of the same name in {@link BlockTypeIds} to enable blocks to be identified
 *
 * This class is generated automatically from source class {@link AxolotlBlocksInputs}. Do not modify it manually.
 * It must be regenerated whenever the source class is changed.
 * @see build/codegen/registry-interface.php
 */
final class AxolotlBlocks{
	private static BeeHive $_mBEEHIVE;
	private static BeeNest $_mBEE_NEST;
	private static Bush $_mBUSH;
	private static CalibratedSculkSensor $_mCALIBRATED_SCULK_SENSOR;
	private static CommandBlock $_mCHAIN_COMMAND_BLOCK;
	private static ClosedEyeblossom $_mCLOSED_EYEBLOSSOM;
	private static CommandBlock $_mCOMMAND_BLOCK;
	private static Composter $_mCOMPOSTER;
	private static Conduit $_mCONDUIT;
	private static Chest $_mCOPPER_CHEST;
	private static CopperGolem $_mCOPPER_GOLEM_STATUE;
	private static CreakingHeart $_mCREAKING_HEART;
	private static Coral $_mDEAD_BRAIN_CORAL;
	private static CoralBlock $_mDEAD_BRAIN_CORAL_BLOCK;
	private static Coral $_mDEAD_BUBBLE_CORAL;
	private static CoralBlock $_mDEAD_BUBBLE_CORAL_BLOCK;
	private static Coral $_mDEAD_FIRE_CORAL;
	private static CoralBlock $_mDEAD_FIRE_CORAL_BLOCK;
	private static Coral $_mDEAD_HORN_CORAL;
	private static CoralBlock $_mDEAD_HORN_CORAL_BLOCK;
	private static Coral $_mDEAD_TUBE_CORAL;
	private static CoralBlock $_mDEAD_TUBE_CORAL_BLOCK;
	private static DecoratedPot $_mDECORATED_POT;
	private static DriedGhast $_mDRIED_GHAST;
	private static Opaque $_mDRIPSTONE_BLOCK;
	private static Chest $_mEXPOSED_COPPER_CHEST;
	private static CopperGolem $_mEXPOSED_COPPER_GOLEM_STATUE;
	private static FireflyBush $_mFIREFLY_BUSH;
	private static Frogspawn $_mFROG_SPAWN;
	private static Flower $_mGOLDEN_DANDELION;
	private static Grindstone $_mGRINDSTONE;
	private static HoneyBlock $_mHONEY_BLOCK;
	private static Kelp $_mKELP_BLOCK;
	private static LeafLitter $_mLEAF_LITTER;
	private static Opaque $_mLODESTONE;
	private static MossBlock $_mMOSS_BLOCK;
	private static MossCarpet $_mMOSS_CARPET;
	private static OpenEyeblossom $_mOPEN_EYEBLOSSOM;
	private static Chest $_mOXIDISED_COPPER_CHEST;
	private static CopperGolem $_mOXIDISED_COPPER_GOLEM_STATUE;
	private static PaleHangingMoss $_mPALE_HANGING_MOSS;
	private static PaleMossBlock $_mPALE_MOSS_BLOCK;
	private static PaleMossCarpet $_mPALE_MOSS_CARPET;
	private static PointedDripstone $_mPOINTED_DRIPSTONE;
	private static PowderSnow $_mPOWDER_SNOW;
	private static CommandBlock $_mREPEATING_COMMAND_BLOCK;
	private static Scaffolding $_mSCAFFOLDING;
	private static SculkCatalyst $_mSCULK_CATALYST;
	private static SculkSensor $_mSCULK_SENSOR;
	private static SculkShrieker $_mSCULK_SHRIEKER;
	private static SculkVein $_mSCULK_VEIN;
	private static SeaGrass $_mSEAGRASS;
	private static ShortDryGrass $_mSHORT_DRY_GRASS;
	private static SnifferEgg $_mSNIFFER_EGG;
	private static SuspiciousGravel $_mSUSPICIOUS_GRAVEL;
	private static SuspiciousSand $_mSUSPICIOUS_SAND;
	private static TallDryGrass $_mTALL_DRY_GRASS;
	private static Transparent $_mTARGET;
	private static TrialSpawner $_mTRIAL_SPAWNER;
	private static TurtleEgg $_mTURTLE_EGG;
	private static Vault $_mVAULT;
	private static Chest $_mWAXED_COPPER_CHEST;
	private static CopperGolem $_mWAXED_COPPER_GOLEM_STATUE;
	private static Chest $_mWAXED_EXPOSED_COPPER_CHEST;
	private static CopperGolem $_mWAXED_EXPOSED_COPPER_GOLEM_STATUE;
	private static Chest $_mWAXED_OXIDISED_COPPER_CHEST;
	private static CopperGolem $_mWAXED_OXIDISED_COPPER_GOLEM_STATUE;
	private static Chest $_mWAXED_WEATHERED_COPPER_CHEST;
	private static CopperGolem $_mWAXED_WEATHERED_COPPER_GOLEM_STATUE;
	private static Chest $_mWEATHERED_COPPER_CHEST;
	private static CopperGolem $_mWEATHERED_COPPER_GOLEM_STATUE;
	private static Flower $_mWILDFLOWERS;

	/**
	 * @var Block[]
	 * @phpstan-var array<string, Block>
	 */
	private static array $members;

	private static bool $initialized = false;

	private function __construct(){
		//NOOP
	}

	/**
	 * Hack to allow ignoring PHPStan wrong type assignment error in one place instead of hundreds or thousands
	 * Assumes that the input value already matches the expected type. If not, a TypeError will be thrown on assignment.
	 *
	 * @phpstan-param \Closure(never) : Block $closure
	 */
	private static function unsafeAssign(\Closure $closure, Block $memberValue) : void{
		/**
		 * This type is not correct either (the param is actually a subtype of Block) but it's called
		 * unsafeAssign for a reason :)
		 * @phpstan-var \Closure(Block) : Block $closure
		 */
		$closure($memberValue);
	}

	/**
	 * @return \Closure[]
	 * @phpstan-return array<string, \Closure(never) : Block>
	 */
	private static function getInitAssigners() : array{
		return [
			"beehive" => fn(BeeHive $v) => self::$_mBEEHIVE = $v,
			"bee_nest" => fn(BeeNest $v) => self::$_mBEE_NEST = $v,
			"bush" => fn(Bush $v) => self::$_mBUSH = $v,
			"calibrated_sculk_sensor" => fn(CalibratedSculkSensor $v) => self::$_mCALIBRATED_SCULK_SENSOR = $v,
			"chain_command_block" => fn(CommandBlock $v) => self::$_mCHAIN_COMMAND_BLOCK = $v,
			"closed_eyeblossom" => fn(ClosedEyeblossom $v) => self::$_mCLOSED_EYEBLOSSOM = $v,
			"command_block" => fn(CommandBlock $v) => self::$_mCOMMAND_BLOCK = $v,
			"composter" => fn(Composter $v) => self::$_mCOMPOSTER = $v,
			"conduit" => fn(Conduit $v) => self::$_mCONDUIT = $v,
			"copper_chest" => fn(Chest $v) => self::$_mCOPPER_CHEST = $v,
			"copper_golem_statue" => fn(CopperGolem $v) => self::$_mCOPPER_GOLEM_STATUE = $v,
			"creaking_heart" => fn(CreakingHeart $v) => self::$_mCREAKING_HEART = $v,
			"dead_brain_coral" => fn(Coral $v) => self::$_mDEAD_BRAIN_CORAL = $v,
			"dead_brain_coral_block" => fn(CoralBlock $v) => self::$_mDEAD_BRAIN_CORAL_BLOCK = $v,
			"dead_bubble_coral" => fn(Coral $v) => self::$_mDEAD_BUBBLE_CORAL = $v,
			"dead_bubble_coral_block" => fn(CoralBlock $v) => self::$_mDEAD_BUBBLE_CORAL_BLOCK = $v,
			"dead_fire_coral" => fn(Coral $v) => self::$_mDEAD_FIRE_CORAL = $v,
			"dead_fire_coral_block" => fn(CoralBlock $v) => self::$_mDEAD_FIRE_CORAL_BLOCK = $v,
			"dead_horn_coral" => fn(Coral $v) => self::$_mDEAD_HORN_CORAL = $v,
			"dead_horn_coral_block" => fn(CoralBlock $v) => self::$_mDEAD_HORN_CORAL_BLOCK = $v,
			"dead_tube_coral" => fn(Coral $v) => self::$_mDEAD_TUBE_CORAL = $v,
			"dead_tube_coral_block" => fn(CoralBlock $v) => self::$_mDEAD_TUBE_CORAL_BLOCK = $v,
			"decorated_pot" => fn(DecoratedPot $v) => self::$_mDECORATED_POT = $v,
			"dried_ghast" => fn(DriedGhast $v) => self::$_mDRIED_GHAST = $v,
			"dripstone_block" => fn(Opaque $v) => self::$_mDRIPSTONE_BLOCK = $v,
			"exposed_copper_chest" => fn(Chest $v) => self::$_mEXPOSED_COPPER_CHEST = $v,
			"exposed_copper_golem_statue" => fn(CopperGolem $v) => self::$_mEXPOSED_COPPER_GOLEM_STATUE = $v,
			"firefly_bush" => fn(FireflyBush $v) => self::$_mFIREFLY_BUSH = $v,
			"frog_spawn" => fn(Frogspawn $v) => self::$_mFROG_SPAWN = $v,
			"golden_dandelion" => fn(Flower $v) => self::$_mGOLDEN_DANDELION = $v,
			"grindstone" => fn(Grindstone $v) => self::$_mGRINDSTONE = $v,
			"honey_block" => fn(HoneyBlock $v) => self::$_mHONEY_BLOCK = $v,
			"kelp_block" => fn(Kelp $v) => self::$_mKELP_BLOCK = $v,
			"leaf_litter" => fn(LeafLitter $v) => self::$_mLEAF_LITTER = $v,
			"lodestone" => fn(Opaque $v) => self::$_mLODESTONE = $v,
			"moss_block" => fn(MossBlock $v) => self::$_mMOSS_BLOCK = $v,
			"moss_carpet" => fn(MossCarpet $v) => self::$_mMOSS_CARPET = $v,
			"open_eyeblossom" => fn(OpenEyeblossom $v) => self::$_mOPEN_EYEBLOSSOM = $v,
			"oxidised_copper_chest" => fn(Chest $v) => self::$_mOXIDISED_COPPER_CHEST = $v,
			"oxidised_copper_golem_statue" => fn(CopperGolem $v) => self::$_mOXIDISED_COPPER_GOLEM_STATUE = $v,
			"pale_hanging_moss" => fn(PaleHangingMoss $v) => self::$_mPALE_HANGING_MOSS = $v,
			"pale_moss_block" => fn(PaleMossBlock $v) => self::$_mPALE_MOSS_BLOCK = $v,
			"pale_moss_carpet" => fn(PaleMossCarpet $v) => self::$_mPALE_MOSS_CARPET = $v,
			"pointed_dripstone" => fn(PointedDripstone $v) => self::$_mPOINTED_DRIPSTONE = $v,
			"powder_snow" => fn(PowderSnow $v) => self::$_mPOWDER_SNOW = $v,
			"repeating_command_block" => fn(CommandBlock $v) => self::$_mREPEATING_COMMAND_BLOCK = $v,
			"scaffolding" => fn(Scaffolding $v) => self::$_mSCAFFOLDING = $v,
			"sculk_catalyst" => fn(SculkCatalyst $v) => self::$_mSCULK_CATALYST = $v,
			"sculk_sensor" => fn(SculkSensor $v) => self::$_mSCULK_SENSOR = $v,
			"sculk_shrieker" => fn(SculkShrieker $v) => self::$_mSCULK_SHRIEKER = $v,
			"sculk_vein" => fn(SculkVein $v) => self::$_mSCULK_VEIN = $v,
			"seagrass" => fn(SeaGrass $v) => self::$_mSEAGRASS = $v,
			"short_dry_grass" => fn(ShortDryGrass $v) => self::$_mSHORT_DRY_GRASS = $v,
			"sniffer_egg" => fn(SnifferEgg $v) => self::$_mSNIFFER_EGG = $v,
			"suspicious_gravel" => fn(SuspiciousGravel $v) => self::$_mSUSPICIOUS_GRAVEL = $v,
			"suspicious_sand" => fn(SuspiciousSand $v) => self::$_mSUSPICIOUS_SAND = $v,
			"tall_dry_grass" => fn(TallDryGrass $v) => self::$_mTALL_DRY_GRASS = $v,
			"target" => fn(Transparent $v) => self::$_mTARGET = $v,
			"trial_spawner" => fn(TrialSpawner $v) => self::$_mTRIAL_SPAWNER = $v,
			"turtle_egg" => fn(TurtleEgg $v) => self::$_mTURTLE_EGG = $v,
			"vault" => fn(Vault $v) => self::$_mVAULT = $v,
			"waxed_copper_chest" => fn(Chest $v) => self::$_mWAXED_COPPER_CHEST = $v,
			"waxed_copper_golem_statue" => fn(CopperGolem $v) => self::$_mWAXED_COPPER_GOLEM_STATUE = $v,
			"waxed_exposed_copper_chest" => fn(Chest $v) => self::$_mWAXED_EXPOSED_COPPER_CHEST = $v,
			"waxed_exposed_copper_golem_statue" => fn(CopperGolem $v) => self::$_mWAXED_EXPOSED_COPPER_GOLEM_STATUE = $v,
			"waxed_oxidised_copper_chest" => fn(Chest $v) => self::$_mWAXED_OXIDISED_COPPER_CHEST = $v,
			"waxed_oxidised_copper_golem_statue" => fn(CopperGolem $v) => self::$_mWAXED_OXIDISED_COPPER_GOLEM_STATUE = $v,
			"waxed_weathered_copper_chest" => fn(Chest $v) => self::$_mWAXED_WEATHERED_COPPER_CHEST = $v,
			"waxed_weathered_copper_golem_statue" => fn(CopperGolem $v) => self::$_mWAXED_WEATHERED_COPPER_GOLEM_STATUE = $v,
			"weathered_copper_chest" => fn(Chest $v) => self::$_mWEATHERED_COPPER_CHEST = $v,
			"weathered_copper_golem_statue" => fn(CopperGolem $v) => self::$_mWEATHERED_COPPER_GOLEM_STATUE = $v,
			"wildflowers" => fn(Flower $v) => self::$_mWILDFLOWERS = $v,
		];
	}

	private static function init() : void{
		//This nasty mess of closures allows us to suppress PHPStan type assignment errors in one place instead of
		//on every single assignment. This will only run one time on first init, so it's fine for performance.
		if(self::$initialized){
			throw new \LogicException("Circular dependency detected - use RegistrySource->registerDelayed() if the circular dependency can't be avoided");
		}
		self::$initialized = true;
		$assigners = self::getInitAssigners();
		$assigned = [];
		$source = new AxolotlBlocksInputs();
		foreach($source->getAllValues() as $name => $value){
			$assigner = $assigners[$name] ?? throw new \LogicException("Unexpected source registry member \"$name\" (code probably needs regenerating)");
			if(isset($assigned[$name])){
				//this should be prevented by RegistrySource, but it doesn't hurt to have some redundancy
				throw new \LogicException("Repeated registry source member \"$name\"");
			}
			self::$members[mb_strtoupper($name)] = $value;
			$assigned[$name] = true;
			unset($assigners[$name]);
			self::unsafeAssign($assigner, $value);
		}
		if(count($assigners) > 0){
			throw new \LogicException("Missing values for registry members (code probably needs regenerating): " . implode(", ", array_keys($assigners)));
		}
	}

	/**
	 * @return Block[]
	 * @phpstan-return array<string, Block>
	 */
	public static function getAll() : array{
		if(!isset(self::$members)){ self::init(); }
		return Utils::cloneObjectArray(self::$members);
	}

	public static function BEEHIVE() : BeeHive{
		if(!isset(self::$_mBEEHIVE)){ self::init(); }
		return clone self::$_mBEEHIVE;
	}

	public static function BEE_NEST() : BeeNest{
		if(!isset(self::$_mBEE_NEST)){ self::init(); }
		return clone self::$_mBEE_NEST;
	}

	public static function BUSH() : Bush{
		if(!isset(self::$_mBUSH)){ self::init(); }
		return clone self::$_mBUSH;
	}

	public static function CALIBRATED_SCULK_SENSOR() : CalibratedSculkSensor{
		if(!isset(self::$_mCALIBRATED_SCULK_SENSOR)){ self::init(); }
		return clone self::$_mCALIBRATED_SCULK_SENSOR;
	}

	public static function CHAIN_COMMAND_BLOCK() : CommandBlock{
		if(!isset(self::$_mCHAIN_COMMAND_BLOCK)){ self::init(); }
		return clone self::$_mCHAIN_COMMAND_BLOCK;
	}

	public static function CLOSED_EYEBLOSSOM() : ClosedEyeblossom{
		if(!isset(self::$_mCLOSED_EYEBLOSSOM)){ self::init(); }
		return clone self::$_mCLOSED_EYEBLOSSOM;
	}

	public static function COMMAND_BLOCK() : CommandBlock{
		if(!isset(self::$_mCOMMAND_BLOCK)){ self::init(); }
		return clone self::$_mCOMMAND_BLOCK;
	}

	public static function COMPOSTER() : Composter{
		if(!isset(self::$_mCOMPOSTER)){ self::init(); }
		return clone self::$_mCOMPOSTER;
	}

	public static function CONDUIT() : Conduit{
		if(!isset(self::$_mCONDUIT)){ self::init(); }
		return clone self::$_mCONDUIT;
	}

	public static function COPPER_CHEST() : Chest{
		if(!isset(self::$_mCOPPER_CHEST)){ self::init(); }
		return clone self::$_mCOPPER_CHEST;
	}

	public static function COPPER_GOLEM_STATUE() : CopperGolem{
		if(!isset(self::$_mCOPPER_GOLEM_STATUE)){ self::init(); }
		return clone self::$_mCOPPER_GOLEM_STATUE;
	}

	public static function CREAKING_HEART() : CreakingHeart{
		if(!isset(self::$_mCREAKING_HEART)){ self::init(); }
		return clone self::$_mCREAKING_HEART;
	}

	public static function DEAD_BRAIN_CORAL() : Coral{
		if(!isset(self::$_mDEAD_BRAIN_CORAL)){ self::init(); }
		return clone self::$_mDEAD_BRAIN_CORAL;
	}

	public static function DEAD_BRAIN_CORAL_BLOCK() : CoralBlock{
		if(!isset(self::$_mDEAD_BRAIN_CORAL_BLOCK)){ self::init(); }
		return clone self::$_mDEAD_BRAIN_CORAL_BLOCK;
	}

	public static function DEAD_BUBBLE_CORAL() : Coral{
		if(!isset(self::$_mDEAD_BUBBLE_CORAL)){ self::init(); }
		return clone self::$_mDEAD_BUBBLE_CORAL;
	}

	public static function DEAD_BUBBLE_CORAL_BLOCK() : CoralBlock{
		if(!isset(self::$_mDEAD_BUBBLE_CORAL_BLOCK)){ self::init(); }
		return clone self::$_mDEAD_BUBBLE_CORAL_BLOCK;
	}

	public static function DEAD_FIRE_CORAL() : Coral{
		if(!isset(self::$_mDEAD_FIRE_CORAL)){ self::init(); }
		return clone self::$_mDEAD_FIRE_CORAL;
	}

	public static function DEAD_FIRE_CORAL_BLOCK() : CoralBlock{
		if(!isset(self::$_mDEAD_FIRE_CORAL_BLOCK)){ self::init(); }
		return clone self::$_mDEAD_FIRE_CORAL_BLOCK;
	}

	public static function DEAD_HORN_CORAL() : Coral{
		if(!isset(self::$_mDEAD_HORN_CORAL)){ self::init(); }
		return clone self::$_mDEAD_HORN_CORAL;
	}

	public static function DEAD_HORN_CORAL_BLOCK() : CoralBlock{
		if(!isset(self::$_mDEAD_HORN_CORAL_BLOCK)){ self::init(); }
		return clone self::$_mDEAD_HORN_CORAL_BLOCK;
	}

	public static function DEAD_TUBE_CORAL() : Coral{
		if(!isset(self::$_mDEAD_TUBE_CORAL)){ self::init(); }
		return clone self::$_mDEAD_TUBE_CORAL;
	}

	public static function DEAD_TUBE_CORAL_BLOCK() : CoralBlock{
		if(!isset(self::$_mDEAD_TUBE_CORAL_BLOCK)){ self::init(); }
		return clone self::$_mDEAD_TUBE_CORAL_BLOCK;
	}

	public static function DECORATED_POT() : DecoratedPot{
		if(!isset(self::$_mDECORATED_POT)){ self::init(); }
		return clone self::$_mDECORATED_POT;
	}

	public static function DRIED_GHAST() : DriedGhast{
		if(!isset(self::$_mDRIED_GHAST)){ self::init(); }
		return clone self::$_mDRIED_GHAST;
	}

	public static function DRIPSTONE_BLOCK() : Opaque{
		if(!isset(self::$_mDRIPSTONE_BLOCK)){ self::init(); }
		return clone self::$_mDRIPSTONE_BLOCK;
	}

	public static function EXPOSED_COPPER_CHEST() : Chest{
		if(!isset(self::$_mEXPOSED_COPPER_CHEST)){ self::init(); }
		return clone self::$_mEXPOSED_COPPER_CHEST;
	}

	public static function EXPOSED_COPPER_GOLEM_STATUE() : CopperGolem{
		if(!isset(self::$_mEXPOSED_COPPER_GOLEM_STATUE)){ self::init(); }
		return clone self::$_mEXPOSED_COPPER_GOLEM_STATUE;
	}

	public static function FIREFLY_BUSH() : FireflyBush{
		if(!isset(self::$_mFIREFLY_BUSH)){ self::init(); }
		return clone self::$_mFIREFLY_BUSH;
	}

	public static function FROG_SPAWN() : Frogspawn{
		if(!isset(self::$_mFROG_SPAWN)){ self::init(); }
		return clone self::$_mFROG_SPAWN;
	}

	public static function GOLDEN_DANDELION() : Flower{
		if(!isset(self::$_mGOLDEN_DANDELION)){ self::init(); }
		return clone self::$_mGOLDEN_DANDELION;
	}

	public static function GRINDSTONE() : Grindstone{
		if(!isset(self::$_mGRINDSTONE)){ self::init(); }
		return clone self::$_mGRINDSTONE;
	}

	public static function HONEY_BLOCK() : HoneyBlock{
		if(!isset(self::$_mHONEY_BLOCK)){ self::init(); }
		return clone self::$_mHONEY_BLOCK;
	}

	public static function KELP_BLOCK() : Kelp{
		if(!isset(self::$_mKELP_BLOCK)){ self::init(); }
		return clone self::$_mKELP_BLOCK;
	}

	public static function LEAF_LITTER() : LeafLitter{
		if(!isset(self::$_mLEAF_LITTER)){ self::init(); }
		return clone self::$_mLEAF_LITTER;
	}

	public static function LODESTONE() : Opaque{
		if(!isset(self::$_mLODESTONE)){ self::init(); }
		return clone self::$_mLODESTONE;
	}

	public static function MOSS_BLOCK() : MossBlock{
		if(!isset(self::$_mMOSS_BLOCK)){ self::init(); }
		return clone self::$_mMOSS_BLOCK;
	}

	public static function MOSS_CARPET() : MossCarpet{
		if(!isset(self::$_mMOSS_CARPET)){ self::init(); }
		return clone self::$_mMOSS_CARPET;
	}

	public static function OPEN_EYEBLOSSOM() : OpenEyeblossom{
		if(!isset(self::$_mOPEN_EYEBLOSSOM)){ self::init(); }
		return clone self::$_mOPEN_EYEBLOSSOM;
	}

	public static function OXIDISED_COPPER_CHEST() : Chest{
		if(!isset(self::$_mOXIDISED_COPPER_CHEST)){ self::init(); }
		return clone self::$_mOXIDISED_COPPER_CHEST;
	}

	public static function OXIDISED_COPPER_GOLEM_STATUE() : CopperGolem{
		if(!isset(self::$_mOXIDISED_COPPER_GOLEM_STATUE)){ self::init(); }
		return clone self::$_mOXIDISED_COPPER_GOLEM_STATUE;
	}

	public static function PALE_HANGING_MOSS() : PaleHangingMoss{
		if(!isset(self::$_mPALE_HANGING_MOSS)){ self::init(); }
		return clone self::$_mPALE_HANGING_MOSS;
	}

	public static function PALE_MOSS_BLOCK() : PaleMossBlock{
		if(!isset(self::$_mPALE_MOSS_BLOCK)){ self::init(); }
		return clone self::$_mPALE_MOSS_BLOCK;
	}

	public static function PALE_MOSS_CARPET() : PaleMossCarpet{
		if(!isset(self::$_mPALE_MOSS_CARPET)){ self::init(); }
		return clone self::$_mPALE_MOSS_CARPET;
	}

	public static function POINTED_DRIPSTONE() : PointedDripstone{
		if(!isset(self::$_mPOINTED_DRIPSTONE)){ self::init(); }
		return clone self::$_mPOINTED_DRIPSTONE;
	}

	public static function POWDER_SNOW() : PowderSnow{
		if(!isset(self::$_mPOWDER_SNOW)){ self::init(); }
		return clone self::$_mPOWDER_SNOW;
	}

	public static function REPEATING_COMMAND_BLOCK() : CommandBlock{
		if(!isset(self::$_mREPEATING_COMMAND_BLOCK)){ self::init(); }
		return clone self::$_mREPEATING_COMMAND_BLOCK;
	}

	public static function SCAFFOLDING() : Scaffolding{
		if(!isset(self::$_mSCAFFOLDING)){ self::init(); }
		return clone self::$_mSCAFFOLDING;
	}

	public static function SCULK_CATALYST() : SculkCatalyst{
		if(!isset(self::$_mSCULK_CATALYST)){ self::init(); }
		return clone self::$_mSCULK_CATALYST;
	}

	public static function SCULK_SENSOR() : SculkSensor{
		if(!isset(self::$_mSCULK_SENSOR)){ self::init(); }
		return clone self::$_mSCULK_SENSOR;
	}

	public static function SCULK_SHRIEKER() : SculkShrieker{
		if(!isset(self::$_mSCULK_SHRIEKER)){ self::init(); }
		return clone self::$_mSCULK_SHRIEKER;
	}

	public static function SCULK_VEIN() : SculkVein{
		if(!isset(self::$_mSCULK_VEIN)){ self::init(); }
		return clone self::$_mSCULK_VEIN;
	}

	public static function SEAGRASS() : SeaGrass{
		if(!isset(self::$_mSEAGRASS)){ self::init(); }
		return clone self::$_mSEAGRASS;
	}

	public static function SHORT_DRY_GRASS() : ShortDryGrass{
		if(!isset(self::$_mSHORT_DRY_GRASS)){ self::init(); }
		return clone self::$_mSHORT_DRY_GRASS;
	}

	public static function SNIFFER_EGG() : SnifferEgg{
		if(!isset(self::$_mSNIFFER_EGG)){ self::init(); }
		return clone self::$_mSNIFFER_EGG;
	}

	public static function SUSPICIOUS_GRAVEL() : SuspiciousGravel{
		if(!isset(self::$_mSUSPICIOUS_GRAVEL)){ self::init(); }
		return clone self::$_mSUSPICIOUS_GRAVEL;
	}

	public static function SUSPICIOUS_SAND() : SuspiciousSand{
		if(!isset(self::$_mSUSPICIOUS_SAND)){ self::init(); }
		return clone self::$_mSUSPICIOUS_SAND;
	}

	public static function TALL_DRY_GRASS() : TallDryGrass{
		if(!isset(self::$_mTALL_DRY_GRASS)){ self::init(); }
		return clone self::$_mTALL_DRY_GRASS;
	}

	public static function TARGET() : Transparent{
		if(!isset(self::$_mTARGET)){ self::init(); }
		return clone self::$_mTARGET;
	}

	public static function TRIAL_SPAWNER() : TrialSpawner{
		if(!isset(self::$_mTRIAL_SPAWNER)){ self::init(); }
		return clone self::$_mTRIAL_SPAWNER;
	}

	public static function TURTLE_EGG() : TurtleEgg{
		if(!isset(self::$_mTURTLE_EGG)){ self::init(); }
		return clone self::$_mTURTLE_EGG;
	}

	public static function VAULT() : Vault{
		if(!isset(self::$_mVAULT)){ self::init(); }
		return clone self::$_mVAULT;
	}

	public static function WAXED_COPPER_CHEST() : Chest{
		if(!isset(self::$_mWAXED_COPPER_CHEST)){ self::init(); }
		return clone self::$_mWAXED_COPPER_CHEST;
	}

	public static function WAXED_COPPER_GOLEM_STATUE() : CopperGolem{
		if(!isset(self::$_mWAXED_COPPER_GOLEM_STATUE)){ self::init(); }
		return clone self::$_mWAXED_COPPER_GOLEM_STATUE;
	}

	public static function WAXED_EXPOSED_COPPER_CHEST() : Chest{
		if(!isset(self::$_mWAXED_EXPOSED_COPPER_CHEST)){ self::init(); }
		return clone self::$_mWAXED_EXPOSED_COPPER_CHEST;
	}

	public static function WAXED_EXPOSED_COPPER_GOLEM_STATUE() : CopperGolem{
		if(!isset(self::$_mWAXED_EXPOSED_COPPER_GOLEM_STATUE)){ self::init(); }
		return clone self::$_mWAXED_EXPOSED_COPPER_GOLEM_STATUE;
	}

	public static function WAXED_OXIDISED_COPPER_CHEST() : Chest{
		if(!isset(self::$_mWAXED_OXIDISED_COPPER_CHEST)){ self::init(); }
		return clone self::$_mWAXED_OXIDISED_COPPER_CHEST;
	}

	public static function WAXED_OXIDISED_COPPER_GOLEM_STATUE() : CopperGolem{
		if(!isset(self::$_mWAXED_OXIDISED_COPPER_GOLEM_STATUE)){ self::init(); }
		return clone self::$_mWAXED_OXIDISED_COPPER_GOLEM_STATUE;
	}

	public static function WAXED_WEATHERED_COPPER_CHEST() : Chest{
		if(!isset(self::$_mWAXED_WEATHERED_COPPER_CHEST)){ self::init(); }
		return clone self::$_mWAXED_WEATHERED_COPPER_CHEST;
	}

	public static function WAXED_WEATHERED_COPPER_GOLEM_STATUE() : CopperGolem{
		if(!isset(self::$_mWAXED_WEATHERED_COPPER_GOLEM_STATUE)){ self::init(); }
		return clone self::$_mWAXED_WEATHERED_COPPER_GOLEM_STATUE;
	}

	public static function WEATHERED_COPPER_CHEST() : Chest{
		if(!isset(self::$_mWEATHERED_COPPER_CHEST)){ self::init(); }
		return clone self::$_mWEATHERED_COPPER_CHEST;
	}

	public static function WEATHERED_COPPER_GOLEM_STATUE() : CopperGolem{
		if(!isset(self::$_mWEATHERED_COPPER_GOLEM_STATUE)){ self::init(); }
		return clone self::$_mWEATHERED_COPPER_GOLEM_STATUE;
	}

	public static function WILDFLOWERS() : Flower{
		if(!isset(self::$_mWILDFLOWERS)){ self::init(); }
		return clone self::$_mWILDFLOWERS;
	}
}
