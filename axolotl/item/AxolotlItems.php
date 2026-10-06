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

namespace axolotl\item;

use pocketmine\item\Egg;
use pocketmine\item\Item;
use pocketmine\item\LiquidBucket;
use pocketmine\utils\Utils;
use function array_keys;
use function count;
use function implode;
use function mb_strtoupper;

/**
 * Allows getting a new instance of any item implemented by axolotl-pm
 * Every item here also has a constant of the same name in {@link ItemTypeIds} to enable items to be identified
 *
 * This class is generated automatically from source class {@link AxolotlItemsInputs}. Do not modify it manually.
 * It must be regenerated whenever the source class is changed.
 * @see build/codegen/registry-interface.php
 */
final class AxolotlItems{
	private static ChestBoat $_mACACIA_CHEST_BOAT;
	private static PotterySherd $_mANGLER_POTTERY_SHERD;
	private static PotterySherd $_mARCHER_POTTERY_SHERD;
	private static Item $_mARMADILLO_SCUTE;
	private static ArmorStand $_mARMOR_STAND;
	private static PotterySherd $_mARMS_POTTERY_SHERD;
	private static LiquidBucket $_mAXOLOTL_BUCKET;
	private static ChestBoat $_mBIRCH_CHEST_BOAT;
	private static Bundle $_mBLACK_BUNDLE;
	private static Harness $_mBLACK_HARNESS;
	private static PotterySherd $_mBLADE_POTTERY_SHERD;
	private static Bundle $_mBLUE_BUNDLE;
	private static Egg $_mBLUE_EGG;
	private static Harness $_mBLUE_HARNESS;
	private static BannerPattern $_mBORDER_BANNER_PATTERN;
	private static Item $_mBREEZE_ROD;
	private static PotterySherd $_mBREWER_POTTERY_SHERD;
	private static BannerPattern $_mBRICKS_BANNER_PATTERN;
	private static Bundle $_mBROWN_BUNDLE;
	private static Egg $_mBROWN_EGG;
	private static Harness $_mBROWN_HARNESS;
	private static Brush $_mBRUSH;
	private static Bundle $_mBUNDLE;
	private static PotterySherd $_mBURN_POTTERY_SHERD;
	private static CarrotOnAStick $_mCARROT_ON_A_STICK;
	private static BannerPattern $_mCIRCLE_BANNER_PATTERN;
	private static LiquidBucket $_mCOD_BUCKET;
	private static HorseArmor $_mCOPPER_HORSE_ARMOR;
	private static NautilusArmor $_mCOPPER_NAUTILUS_ARMOR;
	private static BannerPattern $_mCREEPER_BANNER_PATTERN;
	private static BannerPattern $_mCROSS_BANNER_PATTERN;
	private static BannerPattern $_mCURLY_BORDER_BANNER_PATTERN;
	private static Bundle $_mCYAN_BUNDLE;
	private static Harness $_mCYAN_HARNESS;
	private static PotterySherd $_mDANGER_POTTERY_SHERD;
	private static ChestBoat $_mDARK_OAK_CHEST_BOAT;
	private static BannerPattern $_mDIAGONAL_LEFT_BANNER_PATTERN;
	private static BannerPattern $_mDIAGONAL_RIGHT_BANNER_PATTERN;
	private static BannerPattern $_mDIAGONAL_UP_LEFT_BANNER_PATTERN;
	private static BannerPattern $_mDIAGONAL_UP_RIGHT_BANNER_PATTERN;
	private static HorseArmor $_mDIAMOND_HORSE_ARMOR;
	private static NautilusArmor $_mDIAMOND_NAUTILUS_ARMOR;
	private static Elytra $_mELYTRA;
	private static Item $_mEMPTY_LOCATOR_MAP;
	private static Item $_mEMPTY_MAP;
	private static Item $_mENDER_EYE;
	private static PotterySherd $_mEXPLORER_POTTERY_SHERD;
	private static BannerPattern $_mFLOWER_BANNER_PATTERN;
	private static BannerPattern $_mFLOW_BANNER_PATTERN;
	private static PotterySherd $_mFLOW_POTTERY_SHERD;
	private static PotterySherd $_mFRIEND_POTTERY_SHERD;
	private static BannerPattern $_mGLOBE_BANNER_PATTERN;
	private static PotterySherd $_mGLUSTER_POTTERY_SHERD;
	private static HorseArmor $_mGOLDEN_HORSE_ARMOR;
	private static NautilusArmor $_mGOLDEN_NAUTILUS_ARMOR;
	private static BannerPattern $_mGRADIENT_BANNER_PATTERN;
	private static BannerPattern $_mGRADIENT_UP_BANNER_PATTERN;
	private static Bundle $_mGRAY_BUNDLE;
	private static Harness $_mGRAY_HARNESS;
	private static Bundle $_mGREEN_BUNDLE;
	private static Harness $_mGREEN_HARNESS;
	private static BannerPattern $_mGUSTER_BANNER_PATTERN;
	private static BannerPattern $_mHALF_HORIZONTAL_BANNER_PATTERN;
	private static BannerPattern $_mHALF_HORIZONTAL_BOTTOM_BANNER_PATTERN;
	private static BannerPattern $_mHALF_VERTICAL_BANNER_PATTERN;
	private static BannerPattern $_mHALF_VERTICAL_RIGHT_BANNER_PATTERN;
	private static PotterySherd $_mHEARTBREAK_POTTERY_SHERD;
	private static PotterySherd $_mHEART_POTTERY_SHERD;
	private static PotterySherd $_mHOWL_POTTERY_SHERD;
	private static HorseArmor $_mIRON_HORSE_ARMOR;
	private static NautilusArmor $_mIRON_NAUTILUS_ARMOR;
	private static ChestBoat $_mJUNGLE_CHEST_BOAT;
	private static Kelp $_mKELP;
	private static Item $_mLEAD;
	private static HorseArmor $_mLEATHER_HORSE_ARMOR;
	private static Bundle $_mLIGHT_BLUE_BUNDLE;
	private static Harness $_mLIGHT_BLUE_HARNESS;
	private static Bundle $_mLIGHT_GRAY_BUNDLE;
	private static Harness $_mLIGHT_GRAY_HARNESS;
	private static Bundle $_mLIME_BUNDLE;
	private static Harness $_mLIME_HARNESS;
	private static Mace $_mMACE;
	private static Bundle $_mMAGENTA_BUNDLE;
	private static Harness $_mMAGENTA_HARNESS;
	private static ChestBoat $_mMANGROVE_CHEST_BOAT;
	private static PotterySherd $_mMINER_POTTERY_SHERD;
	private static BannerPattern $_mMOJANG_BANNER_PATTERN;
	private static PotterySherd $_mMOURNER_POTTERY_SHERD;
	private static HorseArmor $_mNETHERITE_HORSE_ARMOR;
	private static NautilusArmor $_mNETHERITE_NAUTILUS_ARMOR;
	private static ChestBoat $_mOAK_CHEST_BOAT;
	private static OminousBottle $_mOMINOUS_BOTTLE;
	private static Item $_mOMINOUS_TRIAL_KEY;
	private static Bundle $_mORANGE_BUNDLE;
	private static Harness $_mORANGE_HARNESS;
	private static BannerPattern $_mPIGLIN_BANNER_PATTERN;
	private static Bundle $_mPINK_BUNDLE;
	private static Harness $_mPINK_HARNESS;
	private static PotterySherd $_mPLENTY_POTTERY_SHERD;
	private static PowerSnowBucket $_mPOWDER_SNOW_BUCKET;
	private static PotterySherd $_mPRIZE_POTTERY_SHERD;
	private static LiquidBucket $_mPUFFERFISH_BUCKET;
	private static Bundle $_mPURPLE_BUNDLE;
	private static Harness $_mPURPLE_HARNESS;
	private static Bundle $_mRED_BUNDLE;
	private static Harness $_mRED_HARNESS;
	private static BannerPattern $_mRHOMBUS_BANNER_PATTERN;
	private static Item $_mSADDLE;
	private static LiquidBucket $_mSALMON_BUCKET;
	private static PotterySherd $_mSCRAPE_POTTERY_SHERD;
	private static PotterySherd $_mSHEAF_POTTERY_SHERD;
	private static PotterySherd $_mSHELTER_POTTERY_SHERD;
	private static Shield $_mSHIELD;
	private static BannerPattern $_mSKULL_BANNER_PATTERN;
	private static PotterySherd $_mSKULL_POTTERY_SHERD;
	private static BannerPattern $_mSMALL_STRIPES_BANNER_PATTERN;
	private static PotterySherd $_mSNORT_POTTERY_SHERD;
	private static ChestBoat $_mSPRUCE_CHEST_BOAT;
	private static BannerPattern $_mSQUARE_BOTTOM_LEFT_BANNER_PATTERN;
	private static BannerPattern $_mSQUARE_BOTTOM_RIGHT_BANNER_PATTERN;
	private static BannerPattern $_mSQUARE_TOP_LEFT_BANNER_PATTERN;
	private static BannerPattern $_mSQUARE_TOP_RIGHT_BANNER_PATTERN;
	private static BannerPattern $_mSTRAIGHT_CROSS_BANNER_PATTERN;
	private static BannerPattern $_mSTRIPE_BOTTOM_BANNER_PATTERN;
	private static BannerPattern $_mSTRIPE_CENTER_BANNER_PATTERN;
	private static BannerPattern $_mSTRIPE_DOWNLEFT_BANNER_PATTERN;
	private static BannerPattern $_mSTRIPE_DOWNRIGHT_BANNER_PATTERN;
	private static BannerPattern $_mSTRIPE_LEFT_BANNER_PATTERN;
	private static BannerPattern $_mSTRIPE_MIDDLE_BANNER_PATTERN;
	private static BannerPattern $_mSTRIPE_RIGHT_BANNER_PATTERN;
	private static BannerPattern $_mSTRIPE_TOP_BANNER_PATTERN;
	private static LiquidBucket $_mTADPOLE_BUCKET;
	private static Item $_mTRIAL_KEY;
	private static BannerPattern $_mTRIANGLES_BOTTOM_BANNER_PATTERN;
	private static BannerPattern $_mTRIANGLES_TOP_BANNER_PATTERN;
	private static BannerPattern $_mTRIANGLE_BOTTOM_BANNER_PATTERN;
	private static BannerPattern $_mTRIANGLE_TOP_BANNER_PATTERN;
	private static LiquidBucket $_mTROPICAL_FISH_BUCKET;
	private static WarpedFungusOnAStick $_mWARPED_FUNGUS_ON_A_STICK;
	private static Bundle $_mWHITE_BUNDLE;
	private static Harness $_mWHITE_HARNESS;
	private static WindCharge $_mWIND_CHARGE;
	private static WolfArmor $_mWOLF_ARMOR;
	private static Bundle $_mYELLOW_BUNDLE;
	private static Harness $_mYELLOW_HARNESS;

	/**
	 * @var Item[]
	 * @phpstan-var array<string, Item>
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
	 * @phpstan-param \Closure(never) : Item $closure
	 */
	private static function unsafeAssign(\Closure $closure, Item $memberValue) : void{
		/**
		 * This type is not correct either (the param is actually a subtype of Item) but it's called
		 * unsafeAssign for a reason :)
		 * @phpstan-var \Closure(Item) : Item $closure
		 */
		$closure($memberValue);
	}

	/**
	 * @return \Closure[]
	 * @phpstan-return array<string, \Closure(never) : Item>
	 */
	private static function getInitAssigners() : array{
		return [
			"acacia_chest_boat" => fn(ChestBoat $v) => self::$_mACACIA_CHEST_BOAT = $v,
			"angler_pottery_sherd" => fn(PotterySherd $v) => self::$_mANGLER_POTTERY_SHERD = $v,
			"archer_pottery_sherd" => fn(PotterySherd $v) => self::$_mARCHER_POTTERY_SHERD = $v,
			"armadillo_scute" => fn(Item $v) => self::$_mARMADILLO_SCUTE = $v,
			"armor_stand" => fn(ArmorStand $v) => self::$_mARMOR_STAND = $v,
			"arms_pottery_sherd" => fn(PotterySherd $v) => self::$_mARMS_POTTERY_SHERD = $v,
			"axolotl_bucket" => fn(LiquidBucket $v) => self::$_mAXOLOTL_BUCKET = $v,
			"birch_chest_boat" => fn(ChestBoat $v) => self::$_mBIRCH_CHEST_BOAT = $v,
			"black_bundle" => fn(Bundle $v) => self::$_mBLACK_BUNDLE = $v,
			"black_harness" => fn(Harness $v) => self::$_mBLACK_HARNESS = $v,
			"blade_pottery_sherd" => fn(PotterySherd $v) => self::$_mBLADE_POTTERY_SHERD = $v,
			"blue_bundle" => fn(Bundle $v) => self::$_mBLUE_BUNDLE = $v,
			"blue_egg" => fn(Egg $v) => self::$_mBLUE_EGG = $v,
			"blue_harness" => fn(Harness $v) => self::$_mBLUE_HARNESS = $v,
			"border_banner_pattern" => fn(BannerPattern $v) => self::$_mBORDER_BANNER_PATTERN = $v,
			"breeze_rod" => fn(Item $v) => self::$_mBREEZE_ROD = $v,
			"brewer_pottery_sherd" => fn(PotterySherd $v) => self::$_mBREWER_POTTERY_SHERD = $v,
			"bricks_banner_pattern" => fn(BannerPattern $v) => self::$_mBRICKS_BANNER_PATTERN = $v,
			"brown_bundle" => fn(Bundle $v) => self::$_mBROWN_BUNDLE = $v,
			"brown_egg" => fn(Egg $v) => self::$_mBROWN_EGG = $v,
			"brown_harness" => fn(Harness $v) => self::$_mBROWN_HARNESS = $v,
			"brush" => fn(Brush $v) => self::$_mBRUSH = $v,
			"bundle" => fn(Bundle $v) => self::$_mBUNDLE = $v,
			"burn_pottery_sherd" => fn(PotterySherd $v) => self::$_mBURN_POTTERY_SHERD = $v,
			"carrot_on_a_stick" => fn(CarrotOnAStick $v) => self::$_mCARROT_ON_A_STICK = $v,
			"circle_banner_pattern" => fn(BannerPattern $v) => self::$_mCIRCLE_BANNER_PATTERN = $v,
			"cod_bucket" => fn(LiquidBucket $v) => self::$_mCOD_BUCKET = $v,
			"copper_horse_armor" => fn(HorseArmor $v) => self::$_mCOPPER_HORSE_ARMOR = $v,
			"copper_nautilus_armor" => fn(NautilusArmor $v) => self::$_mCOPPER_NAUTILUS_ARMOR = $v,
			"creeper_banner_pattern" => fn(BannerPattern $v) => self::$_mCREEPER_BANNER_PATTERN = $v,
			"cross_banner_pattern" => fn(BannerPattern $v) => self::$_mCROSS_BANNER_PATTERN = $v,
			"curly_border_banner_pattern" => fn(BannerPattern $v) => self::$_mCURLY_BORDER_BANNER_PATTERN = $v,
			"cyan_bundle" => fn(Bundle $v) => self::$_mCYAN_BUNDLE = $v,
			"cyan_harness" => fn(Harness $v) => self::$_mCYAN_HARNESS = $v,
			"danger_pottery_sherd" => fn(PotterySherd $v) => self::$_mDANGER_POTTERY_SHERD = $v,
			"dark_oak_chest_boat" => fn(ChestBoat $v) => self::$_mDARK_OAK_CHEST_BOAT = $v,
			"diagonal_left_banner_pattern" => fn(BannerPattern $v) => self::$_mDIAGONAL_LEFT_BANNER_PATTERN = $v,
			"diagonal_right_banner_pattern" => fn(BannerPattern $v) => self::$_mDIAGONAL_RIGHT_BANNER_PATTERN = $v,
			"diagonal_up_left_banner_pattern" => fn(BannerPattern $v) => self::$_mDIAGONAL_UP_LEFT_BANNER_PATTERN = $v,
			"diagonal_up_right_banner_pattern" => fn(BannerPattern $v) => self::$_mDIAGONAL_UP_RIGHT_BANNER_PATTERN = $v,
			"diamond_horse_armor" => fn(HorseArmor $v) => self::$_mDIAMOND_HORSE_ARMOR = $v,
			"diamond_nautilus_armor" => fn(NautilusArmor $v) => self::$_mDIAMOND_NAUTILUS_ARMOR = $v,
			"elytra" => fn(Elytra $v) => self::$_mELYTRA = $v,
			"empty_locator_map" => fn(Item $v) => self::$_mEMPTY_LOCATOR_MAP = $v,
			"empty_map" => fn(Item $v) => self::$_mEMPTY_MAP = $v,
			"ender_eye" => fn(Item $v) => self::$_mENDER_EYE = $v,
			"explorer_pottery_sherd" => fn(PotterySherd $v) => self::$_mEXPLORER_POTTERY_SHERD = $v,
			"flower_banner_pattern" => fn(BannerPattern $v) => self::$_mFLOWER_BANNER_PATTERN = $v,
			"flow_banner_pattern" => fn(BannerPattern $v) => self::$_mFLOW_BANNER_PATTERN = $v,
			"flow_pottery_sherd" => fn(PotterySherd $v) => self::$_mFLOW_POTTERY_SHERD = $v,
			"friend_pottery_sherd" => fn(PotterySherd $v) => self::$_mFRIEND_POTTERY_SHERD = $v,
			"globe_banner_pattern" => fn(BannerPattern $v) => self::$_mGLOBE_BANNER_PATTERN = $v,
			"gluster_pottery_sherd" => fn(PotterySherd $v) => self::$_mGLUSTER_POTTERY_SHERD = $v,
			"golden_horse_armor" => fn(HorseArmor $v) => self::$_mGOLDEN_HORSE_ARMOR = $v,
			"golden_nautilus_armor" => fn(NautilusArmor $v) => self::$_mGOLDEN_NAUTILUS_ARMOR = $v,
			"gradient_banner_pattern" => fn(BannerPattern $v) => self::$_mGRADIENT_BANNER_PATTERN = $v,
			"gradient_up_banner_pattern" => fn(BannerPattern $v) => self::$_mGRADIENT_UP_BANNER_PATTERN = $v,
			"gray_bundle" => fn(Bundle $v) => self::$_mGRAY_BUNDLE = $v,
			"gray_harness" => fn(Harness $v) => self::$_mGRAY_HARNESS = $v,
			"green_bundle" => fn(Bundle $v) => self::$_mGREEN_BUNDLE = $v,
			"green_harness" => fn(Harness $v) => self::$_mGREEN_HARNESS = $v,
			"guster_banner_pattern" => fn(BannerPattern $v) => self::$_mGUSTER_BANNER_PATTERN = $v,
			"half_horizontal_banner_pattern" => fn(BannerPattern $v) => self::$_mHALF_HORIZONTAL_BANNER_PATTERN = $v,
			"half_horizontal_bottom_banner_pattern" => fn(BannerPattern $v) => self::$_mHALF_HORIZONTAL_BOTTOM_BANNER_PATTERN = $v,
			"half_vertical_banner_pattern" => fn(BannerPattern $v) => self::$_mHALF_VERTICAL_BANNER_PATTERN = $v,
			"half_vertical_right_banner_pattern" => fn(BannerPattern $v) => self::$_mHALF_VERTICAL_RIGHT_BANNER_PATTERN = $v,
			"heartbreak_pottery_sherd" => fn(PotterySherd $v) => self::$_mHEARTBREAK_POTTERY_SHERD = $v,
			"heart_pottery_sherd" => fn(PotterySherd $v) => self::$_mHEART_POTTERY_SHERD = $v,
			"howl_pottery_sherd" => fn(PotterySherd $v) => self::$_mHOWL_POTTERY_SHERD = $v,
			"iron_horse_armor" => fn(HorseArmor $v) => self::$_mIRON_HORSE_ARMOR = $v,
			"iron_nautilus_armor" => fn(NautilusArmor $v) => self::$_mIRON_NAUTILUS_ARMOR = $v,
			"jungle_chest_boat" => fn(ChestBoat $v) => self::$_mJUNGLE_CHEST_BOAT = $v,
			"kelp" => fn(Kelp $v) => self::$_mKELP = $v,
			"lead" => fn(Item $v) => self::$_mLEAD = $v,
			"leather_horse_armor" => fn(HorseArmor $v) => self::$_mLEATHER_HORSE_ARMOR = $v,
			"light_blue_bundle" => fn(Bundle $v) => self::$_mLIGHT_BLUE_BUNDLE = $v,
			"light_blue_harness" => fn(Harness $v) => self::$_mLIGHT_BLUE_HARNESS = $v,
			"light_gray_bundle" => fn(Bundle $v) => self::$_mLIGHT_GRAY_BUNDLE = $v,
			"light_gray_harness" => fn(Harness $v) => self::$_mLIGHT_GRAY_HARNESS = $v,
			"lime_bundle" => fn(Bundle $v) => self::$_mLIME_BUNDLE = $v,
			"lime_harness" => fn(Harness $v) => self::$_mLIME_HARNESS = $v,
			"mace" => fn(Mace $v) => self::$_mMACE = $v,
			"magenta_bundle" => fn(Bundle $v) => self::$_mMAGENTA_BUNDLE = $v,
			"magenta_harness" => fn(Harness $v) => self::$_mMAGENTA_HARNESS = $v,
			"mangrove_chest_boat" => fn(ChestBoat $v) => self::$_mMANGROVE_CHEST_BOAT = $v,
			"miner_pottery_sherd" => fn(PotterySherd $v) => self::$_mMINER_POTTERY_SHERD = $v,
			"mojang_banner_pattern" => fn(BannerPattern $v) => self::$_mMOJANG_BANNER_PATTERN = $v,
			"mourner_pottery_sherd" => fn(PotterySherd $v) => self::$_mMOURNER_POTTERY_SHERD = $v,
			"netherite_horse_armor" => fn(HorseArmor $v) => self::$_mNETHERITE_HORSE_ARMOR = $v,
			"netherite_nautilus_armor" => fn(NautilusArmor $v) => self::$_mNETHERITE_NAUTILUS_ARMOR = $v,
			"oak_chest_boat" => fn(ChestBoat $v) => self::$_mOAK_CHEST_BOAT = $v,
			"ominous_bottle" => fn(OminousBottle $v) => self::$_mOMINOUS_BOTTLE = $v,
			"ominous_trial_key" => fn(Item $v) => self::$_mOMINOUS_TRIAL_KEY = $v,
			"orange_bundle" => fn(Bundle $v) => self::$_mORANGE_BUNDLE = $v,
			"orange_harness" => fn(Harness $v) => self::$_mORANGE_HARNESS = $v,
			"piglin_banner_pattern" => fn(BannerPattern $v) => self::$_mPIGLIN_BANNER_PATTERN = $v,
			"pink_bundle" => fn(Bundle $v) => self::$_mPINK_BUNDLE = $v,
			"pink_harness" => fn(Harness $v) => self::$_mPINK_HARNESS = $v,
			"plenty_pottery_sherd" => fn(PotterySherd $v) => self::$_mPLENTY_POTTERY_SHERD = $v,
			"powder_snow_bucket" => fn(PowerSnowBucket $v) => self::$_mPOWDER_SNOW_BUCKET = $v,
			"prize_pottery_sherd" => fn(PotterySherd $v) => self::$_mPRIZE_POTTERY_SHERD = $v,
			"pufferfish_bucket" => fn(LiquidBucket $v) => self::$_mPUFFERFISH_BUCKET = $v,
			"purple_bundle" => fn(Bundle $v) => self::$_mPURPLE_BUNDLE = $v,
			"purple_harness" => fn(Harness $v) => self::$_mPURPLE_HARNESS = $v,
			"red_bundle" => fn(Bundle $v) => self::$_mRED_BUNDLE = $v,
			"red_harness" => fn(Harness $v) => self::$_mRED_HARNESS = $v,
			"rhombus_banner_pattern" => fn(BannerPattern $v) => self::$_mRHOMBUS_BANNER_PATTERN = $v,
			"saddle" => fn(Item $v) => self::$_mSADDLE = $v,
			"salmon_bucket" => fn(LiquidBucket $v) => self::$_mSALMON_BUCKET = $v,
			"scrape_pottery_sherd" => fn(PotterySherd $v) => self::$_mSCRAPE_POTTERY_SHERD = $v,
			"sheaf_pottery_sherd" => fn(PotterySherd $v) => self::$_mSHEAF_POTTERY_SHERD = $v,
			"shelter_pottery_sherd" => fn(PotterySherd $v) => self::$_mSHELTER_POTTERY_SHERD = $v,
			"shield" => fn(Shield $v) => self::$_mSHIELD = $v,
			"skull_banner_pattern" => fn(BannerPattern $v) => self::$_mSKULL_BANNER_PATTERN = $v,
			"skull_pottery_sherd" => fn(PotterySherd $v) => self::$_mSKULL_POTTERY_SHERD = $v,
			"small_stripes_banner_pattern" => fn(BannerPattern $v) => self::$_mSMALL_STRIPES_BANNER_PATTERN = $v,
			"snort_pottery_sherd" => fn(PotterySherd $v) => self::$_mSNORT_POTTERY_SHERD = $v,
			"spruce_chest_boat" => fn(ChestBoat $v) => self::$_mSPRUCE_CHEST_BOAT = $v,
			"square_bottom_left_banner_pattern" => fn(BannerPattern $v) => self::$_mSQUARE_BOTTOM_LEFT_BANNER_PATTERN = $v,
			"square_bottom_right_banner_pattern" => fn(BannerPattern $v) => self::$_mSQUARE_BOTTOM_RIGHT_BANNER_PATTERN = $v,
			"square_top_left_banner_pattern" => fn(BannerPattern $v) => self::$_mSQUARE_TOP_LEFT_BANNER_PATTERN = $v,
			"square_top_right_banner_pattern" => fn(BannerPattern $v) => self::$_mSQUARE_TOP_RIGHT_BANNER_PATTERN = $v,
			"straight_cross_banner_pattern" => fn(BannerPattern $v) => self::$_mSTRAIGHT_CROSS_BANNER_PATTERN = $v,
			"stripe_bottom_banner_pattern" => fn(BannerPattern $v) => self::$_mSTRIPE_BOTTOM_BANNER_PATTERN = $v,
			"stripe_center_banner_pattern" => fn(BannerPattern $v) => self::$_mSTRIPE_CENTER_BANNER_PATTERN = $v,
			"stripe_downleft_banner_pattern" => fn(BannerPattern $v) => self::$_mSTRIPE_DOWNLEFT_BANNER_PATTERN = $v,
			"stripe_downright_banner_pattern" => fn(BannerPattern $v) => self::$_mSTRIPE_DOWNRIGHT_BANNER_PATTERN = $v,
			"stripe_left_banner_pattern" => fn(BannerPattern $v) => self::$_mSTRIPE_LEFT_BANNER_PATTERN = $v,
			"stripe_middle_banner_pattern" => fn(BannerPattern $v) => self::$_mSTRIPE_MIDDLE_BANNER_PATTERN = $v,
			"stripe_right_banner_pattern" => fn(BannerPattern $v) => self::$_mSTRIPE_RIGHT_BANNER_PATTERN = $v,
			"stripe_top_banner_pattern" => fn(BannerPattern $v) => self::$_mSTRIPE_TOP_BANNER_PATTERN = $v,
			"tadpole_bucket" => fn(LiquidBucket $v) => self::$_mTADPOLE_BUCKET = $v,
			"trial_key" => fn(Item $v) => self::$_mTRIAL_KEY = $v,
			"triangles_bottom_banner_pattern" => fn(BannerPattern $v) => self::$_mTRIANGLES_BOTTOM_BANNER_PATTERN = $v,
			"triangles_top_banner_pattern" => fn(BannerPattern $v) => self::$_mTRIANGLES_TOP_BANNER_PATTERN = $v,
			"triangle_bottom_banner_pattern" => fn(BannerPattern $v) => self::$_mTRIANGLE_BOTTOM_BANNER_PATTERN = $v,
			"triangle_top_banner_pattern" => fn(BannerPattern $v) => self::$_mTRIANGLE_TOP_BANNER_PATTERN = $v,
			"tropical_fish_bucket" => fn(LiquidBucket $v) => self::$_mTROPICAL_FISH_BUCKET = $v,
			"warped_fungus_on_a_stick" => fn(WarpedFungusOnAStick $v) => self::$_mWARPED_FUNGUS_ON_A_STICK = $v,
			"white_bundle" => fn(Bundle $v) => self::$_mWHITE_BUNDLE = $v,
			"white_harness" => fn(Harness $v) => self::$_mWHITE_HARNESS = $v,
			"wind_charge" => fn(WindCharge $v) => self::$_mWIND_CHARGE = $v,
			"wolf_armor" => fn(WolfArmor $v) => self::$_mWOLF_ARMOR = $v,
			"yellow_bundle" => fn(Bundle $v) => self::$_mYELLOW_BUNDLE = $v,
			"yellow_harness" => fn(Harness $v) => self::$_mYELLOW_HARNESS = $v,
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
		$source = new AxolotlItemsInputs();
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
	 * @return Item[]
	 * @phpstan-return array<string, Item>
	 */
	public static function getAll() : array{
		if(!isset(self::$members)){ self::init(); }
		return Utils::cloneObjectArray(self::$members);
	}

	public static function ACACIA_CHEST_BOAT() : ChestBoat{
		if(!isset(self::$_mACACIA_CHEST_BOAT)){ self::init(); }
		return clone self::$_mACACIA_CHEST_BOAT;
	}

	public static function ANGLER_POTTERY_SHERD() : PotterySherd{
		if(!isset(self::$_mANGLER_POTTERY_SHERD)){ self::init(); }
		return clone self::$_mANGLER_POTTERY_SHERD;
	}

	public static function ARCHER_POTTERY_SHERD() : PotterySherd{
		if(!isset(self::$_mARCHER_POTTERY_SHERD)){ self::init(); }
		return clone self::$_mARCHER_POTTERY_SHERD;
	}

	public static function ARMADILLO_SCUTE() : Item{
		if(!isset(self::$_mARMADILLO_SCUTE)){ self::init(); }
		return clone self::$_mARMADILLO_SCUTE;
	}

	public static function ARMOR_STAND() : ArmorStand{
		if(!isset(self::$_mARMOR_STAND)){ self::init(); }
		return clone self::$_mARMOR_STAND;
	}

	public static function ARMS_POTTERY_SHERD() : PotterySherd{
		if(!isset(self::$_mARMS_POTTERY_SHERD)){ self::init(); }
		return clone self::$_mARMS_POTTERY_SHERD;
	}

	public static function AXOLOTL_BUCKET() : LiquidBucket{
		if(!isset(self::$_mAXOLOTL_BUCKET)){ self::init(); }
		return clone self::$_mAXOLOTL_BUCKET;
	}

	public static function BIRCH_CHEST_BOAT() : ChestBoat{
		if(!isset(self::$_mBIRCH_CHEST_BOAT)){ self::init(); }
		return clone self::$_mBIRCH_CHEST_BOAT;
	}

	public static function BLACK_BUNDLE() : Bundle{
		if(!isset(self::$_mBLACK_BUNDLE)){ self::init(); }
		return clone self::$_mBLACK_BUNDLE;
	}

	public static function BLACK_HARNESS() : Harness{
		if(!isset(self::$_mBLACK_HARNESS)){ self::init(); }
		return clone self::$_mBLACK_HARNESS;
	}

	public static function BLADE_POTTERY_SHERD() : PotterySherd{
		if(!isset(self::$_mBLADE_POTTERY_SHERD)){ self::init(); }
		return clone self::$_mBLADE_POTTERY_SHERD;
	}

	public static function BLUE_BUNDLE() : Bundle{
		if(!isset(self::$_mBLUE_BUNDLE)){ self::init(); }
		return clone self::$_mBLUE_BUNDLE;
	}

	public static function BLUE_EGG() : Egg{
		if(!isset(self::$_mBLUE_EGG)){ self::init(); }
		return clone self::$_mBLUE_EGG;
	}

	public static function BLUE_HARNESS() : Harness{
		if(!isset(self::$_mBLUE_HARNESS)){ self::init(); }
		return clone self::$_mBLUE_HARNESS;
	}

	public static function BORDER_BANNER_PATTERN() : BannerPattern{
		if(!isset(self::$_mBORDER_BANNER_PATTERN)){ self::init(); }
		return clone self::$_mBORDER_BANNER_PATTERN;
	}

	public static function BREEZE_ROD() : Item{
		if(!isset(self::$_mBREEZE_ROD)){ self::init(); }
		return clone self::$_mBREEZE_ROD;
	}

	public static function BREWER_POTTERY_SHERD() : PotterySherd{
		if(!isset(self::$_mBREWER_POTTERY_SHERD)){ self::init(); }
		return clone self::$_mBREWER_POTTERY_SHERD;
	}

	public static function BRICKS_BANNER_PATTERN() : BannerPattern{
		if(!isset(self::$_mBRICKS_BANNER_PATTERN)){ self::init(); }
		return clone self::$_mBRICKS_BANNER_PATTERN;
	}

	public static function BROWN_BUNDLE() : Bundle{
		if(!isset(self::$_mBROWN_BUNDLE)){ self::init(); }
		return clone self::$_mBROWN_BUNDLE;
	}

	public static function BROWN_EGG() : Egg{
		if(!isset(self::$_mBROWN_EGG)){ self::init(); }
		return clone self::$_mBROWN_EGG;
	}

	public static function BROWN_HARNESS() : Harness{
		if(!isset(self::$_mBROWN_HARNESS)){ self::init(); }
		return clone self::$_mBROWN_HARNESS;
	}

	public static function BRUSH() : Brush{
		if(!isset(self::$_mBRUSH)){ self::init(); }
		return clone self::$_mBRUSH;
	}

	public static function BUNDLE() : Bundle{
		if(!isset(self::$_mBUNDLE)){ self::init(); }
		return clone self::$_mBUNDLE;
	}

	public static function BURN_POTTERY_SHERD() : PotterySherd{
		if(!isset(self::$_mBURN_POTTERY_SHERD)){ self::init(); }
		return clone self::$_mBURN_POTTERY_SHERD;
	}

	public static function CARROT_ON_A_STICK() : CarrotOnAStick{
		if(!isset(self::$_mCARROT_ON_A_STICK)){ self::init(); }
		return clone self::$_mCARROT_ON_A_STICK;
	}

	public static function CIRCLE_BANNER_PATTERN() : BannerPattern{
		if(!isset(self::$_mCIRCLE_BANNER_PATTERN)){ self::init(); }
		return clone self::$_mCIRCLE_BANNER_PATTERN;
	}

	public static function COD_BUCKET() : LiquidBucket{
		if(!isset(self::$_mCOD_BUCKET)){ self::init(); }
		return clone self::$_mCOD_BUCKET;
	}

	public static function COPPER_HORSE_ARMOR() : HorseArmor{
		if(!isset(self::$_mCOPPER_HORSE_ARMOR)){ self::init(); }
		return clone self::$_mCOPPER_HORSE_ARMOR;
	}

	public static function COPPER_NAUTILUS_ARMOR() : NautilusArmor{
		if(!isset(self::$_mCOPPER_NAUTILUS_ARMOR)){ self::init(); }
		return clone self::$_mCOPPER_NAUTILUS_ARMOR;
	}

	public static function CREEPER_BANNER_PATTERN() : BannerPattern{
		if(!isset(self::$_mCREEPER_BANNER_PATTERN)){ self::init(); }
		return clone self::$_mCREEPER_BANNER_PATTERN;
	}

	public static function CROSS_BANNER_PATTERN() : BannerPattern{
		if(!isset(self::$_mCROSS_BANNER_PATTERN)){ self::init(); }
		return clone self::$_mCROSS_BANNER_PATTERN;
	}

	public static function CURLY_BORDER_BANNER_PATTERN() : BannerPattern{
		if(!isset(self::$_mCURLY_BORDER_BANNER_PATTERN)){ self::init(); }
		return clone self::$_mCURLY_BORDER_BANNER_PATTERN;
	}

	public static function CYAN_BUNDLE() : Bundle{
		if(!isset(self::$_mCYAN_BUNDLE)){ self::init(); }
		return clone self::$_mCYAN_BUNDLE;
	}

	public static function CYAN_HARNESS() : Harness{
		if(!isset(self::$_mCYAN_HARNESS)){ self::init(); }
		return clone self::$_mCYAN_HARNESS;
	}

	public static function DANGER_POTTERY_SHERD() : PotterySherd{
		if(!isset(self::$_mDANGER_POTTERY_SHERD)){ self::init(); }
		return clone self::$_mDANGER_POTTERY_SHERD;
	}

	public static function DARK_OAK_CHEST_BOAT() : ChestBoat{
		if(!isset(self::$_mDARK_OAK_CHEST_BOAT)){ self::init(); }
		return clone self::$_mDARK_OAK_CHEST_BOAT;
	}

	public static function DIAGONAL_LEFT_BANNER_PATTERN() : BannerPattern{
		if(!isset(self::$_mDIAGONAL_LEFT_BANNER_PATTERN)){ self::init(); }
		return clone self::$_mDIAGONAL_LEFT_BANNER_PATTERN;
	}

	public static function DIAGONAL_RIGHT_BANNER_PATTERN() : BannerPattern{
		if(!isset(self::$_mDIAGONAL_RIGHT_BANNER_PATTERN)){ self::init(); }
		return clone self::$_mDIAGONAL_RIGHT_BANNER_PATTERN;
	}

	public static function DIAGONAL_UP_LEFT_BANNER_PATTERN() : BannerPattern{
		if(!isset(self::$_mDIAGONAL_UP_LEFT_BANNER_PATTERN)){ self::init(); }
		return clone self::$_mDIAGONAL_UP_LEFT_BANNER_PATTERN;
	}

	public static function DIAGONAL_UP_RIGHT_BANNER_PATTERN() : BannerPattern{
		if(!isset(self::$_mDIAGONAL_UP_RIGHT_BANNER_PATTERN)){ self::init(); }
		return clone self::$_mDIAGONAL_UP_RIGHT_BANNER_PATTERN;
	}

	public static function DIAMOND_HORSE_ARMOR() : HorseArmor{
		if(!isset(self::$_mDIAMOND_HORSE_ARMOR)){ self::init(); }
		return clone self::$_mDIAMOND_HORSE_ARMOR;
	}

	public static function DIAMOND_NAUTILUS_ARMOR() : NautilusArmor{
		if(!isset(self::$_mDIAMOND_NAUTILUS_ARMOR)){ self::init(); }
		return clone self::$_mDIAMOND_NAUTILUS_ARMOR;
	}

	public static function ELYTRA() : Elytra{
		if(!isset(self::$_mELYTRA)){ self::init(); }
		return clone self::$_mELYTRA;
	}

	public static function EMPTY_LOCATOR_MAP() : Item{
		if(!isset(self::$_mEMPTY_LOCATOR_MAP)){ self::init(); }
		return clone self::$_mEMPTY_LOCATOR_MAP;
	}

	public static function EMPTY_MAP() : Item{
		if(!isset(self::$_mEMPTY_MAP)){ self::init(); }
		return clone self::$_mEMPTY_MAP;
	}

	public static function ENDER_EYE() : Item{
		if(!isset(self::$_mENDER_EYE)){ self::init(); }
		return clone self::$_mENDER_EYE;
	}

	public static function EXPLORER_POTTERY_SHERD() : PotterySherd{
		if(!isset(self::$_mEXPLORER_POTTERY_SHERD)){ self::init(); }
		return clone self::$_mEXPLORER_POTTERY_SHERD;
	}

	public static function FLOWER_BANNER_PATTERN() : BannerPattern{
		if(!isset(self::$_mFLOWER_BANNER_PATTERN)){ self::init(); }
		return clone self::$_mFLOWER_BANNER_PATTERN;
	}

	public static function FLOW_BANNER_PATTERN() : BannerPattern{
		if(!isset(self::$_mFLOW_BANNER_PATTERN)){ self::init(); }
		return clone self::$_mFLOW_BANNER_PATTERN;
	}

	public static function FLOW_POTTERY_SHERD() : PotterySherd{
		if(!isset(self::$_mFLOW_POTTERY_SHERD)){ self::init(); }
		return clone self::$_mFLOW_POTTERY_SHERD;
	}

	public static function FRIEND_POTTERY_SHERD() : PotterySherd{
		if(!isset(self::$_mFRIEND_POTTERY_SHERD)){ self::init(); }
		return clone self::$_mFRIEND_POTTERY_SHERD;
	}

	public static function GLOBE_BANNER_PATTERN() : BannerPattern{
		if(!isset(self::$_mGLOBE_BANNER_PATTERN)){ self::init(); }
		return clone self::$_mGLOBE_BANNER_PATTERN;
	}

	public static function GLUSTER_POTTERY_SHERD() : PotterySherd{
		if(!isset(self::$_mGLUSTER_POTTERY_SHERD)){ self::init(); }
		return clone self::$_mGLUSTER_POTTERY_SHERD;
	}

	public static function GOLDEN_HORSE_ARMOR() : HorseArmor{
		if(!isset(self::$_mGOLDEN_HORSE_ARMOR)){ self::init(); }
		return clone self::$_mGOLDEN_HORSE_ARMOR;
	}

	public static function GOLDEN_NAUTILUS_ARMOR() : NautilusArmor{
		if(!isset(self::$_mGOLDEN_NAUTILUS_ARMOR)){ self::init(); }
		return clone self::$_mGOLDEN_NAUTILUS_ARMOR;
	}

	public static function GRADIENT_BANNER_PATTERN() : BannerPattern{
		if(!isset(self::$_mGRADIENT_BANNER_PATTERN)){ self::init(); }
		return clone self::$_mGRADIENT_BANNER_PATTERN;
	}

	public static function GRADIENT_UP_BANNER_PATTERN() : BannerPattern{
		if(!isset(self::$_mGRADIENT_UP_BANNER_PATTERN)){ self::init(); }
		return clone self::$_mGRADIENT_UP_BANNER_PATTERN;
	}

	public static function GRAY_BUNDLE() : Bundle{
		if(!isset(self::$_mGRAY_BUNDLE)){ self::init(); }
		return clone self::$_mGRAY_BUNDLE;
	}

	public static function GRAY_HARNESS() : Harness{
		if(!isset(self::$_mGRAY_HARNESS)){ self::init(); }
		return clone self::$_mGRAY_HARNESS;
	}

	public static function GREEN_BUNDLE() : Bundle{
		if(!isset(self::$_mGREEN_BUNDLE)){ self::init(); }
		return clone self::$_mGREEN_BUNDLE;
	}

	public static function GREEN_HARNESS() : Harness{
		if(!isset(self::$_mGREEN_HARNESS)){ self::init(); }
		return clone self::$_mGREEN_HARNESS;
	}

	public static function GUSTER_BANNER_PATTERN() : BannerPattern{
		if(!isset(self::$_mGUSTER_BANNER_PATTERN)){ self::init(); }
		return clone self::$_mGUSTER_BANNER_PATTERN;
	}

	public static function HALF_HORIZONTAL_BANNER_PATTERN() : BannerPattern{
		if(!isset(self::$_mHALF_HORIZONTAL_BANNER_PATTERN)){ self::init(); }
		return clone self::$_mHALF_HORIZONTAL_BANNER_PATTERN;
	}

	public static function HALF_HORIZONTAL_BOTTOM_BANNER_PATTERN() : BannerPattern{
		if(!isset(self::$_mHALF_HORIZONTAL_BOTTOM_BANNER_PATTERN)){ self::init(); }
		return clone self::$_mHALF_HORIZONTAL_BOTTOM_BANNER_PATTERN;
	}

	public static function HALF_VERTICAL_BANNER_PATTERN() : BannerPattern{
		if(!isset(self::$_mHALF_VERTICAL_BANNER_PATTERN)){ self::init(); }
		return clone self::$_mHALF_VERTICAL_BANNER_PATTERN;
	}

	public static function HALF_VERTICAL_RIGHT_BANNER_PATTERN() : BannerPattern{
		if(!isset(self::$_mHALF_VERTICAL_RIGHT_BANNER_PATTERN)){ self::init(); }
		return clone self::$_mHALF_VERTICAL_RIGHT_BANNER_PATTERN;
	}

	public static function HEARTBREAK_POTTERY_SHERD() : PotterySherd{
		if(!isset(self::$_mHEARTBREAK_POTTERY_SHERD)){ self::init(); }
		return clone self::$_mHEARTBREAK_POTTERY_SHERD;
	}

	public static function HEART_POTTERY_SHERD() : PotterySherd{
		if(!isset(self::$_mHEART_POTTERY_SHERD)){ self::init(); }
		return clone self::$_mHEART_POTTERY_SHERD;
	}

	public static function HOWL_POTTERY_SHERD() : PotterySherd{
		if(!isset(self::$_mHOWL_POTTERY_SHERD)){ self::init(); }
		return clone self::$_mHOWL_POTTERY_SHERD;
	}

	public static function IRON_HORSE_ARMOR() : HorseArmor{
		if(!isset(self::$_mIRON_HORSE_ARMOR)){ self::init(); }
		return clone self::$_mIRON_HORSE_ARMOR;
	}

	public static function IRON_NAUTILUS_ARMOR() : NautilusArmor{
		if(!isset(self::$_mIRON_NAUTILUS_ARMOR)){ self::init(); }
		return clone self::$_mIRON_NAUTILUS_ARMOR;
	}

	public static function JUNGLE_CHEST_BOAT() : ChestBoat{
		if(!isset(self::$_mJUNGLE_CHEST_BOAT)){ self::init(); }
		return clone self::$_mJUNGLE_CHEST_BOAT;
	}

	public static function KELP() : Kelp{
		if(!isset(self::$_mKELP)){ self::init(); }
		return clone self::$_mKELP;
	}

	public static function LEAD() : Item{
		if(!isset(self::$_mLEAD)){ self::init(); }
		return clone self::$_mLEAD;
	}

	public static function LEATHER_HORSE_ARMOR() : HorseArmor{
		if(!isset(self::$_mLEATHER_HORSE_ARMOR)){ self::init(); }
		return clone self::$_mLEATHER_HORSE_ARMOR;
	}

	public static function LIGHT_BLUE_BUNDLE() : Bundle{
		if(!isset(self::$_mLIGHT_BLUE_BUNDLE)){ self::init(); }
		return clone self::$_mLIGHT_BLUE_BUNDLE;
	}

	public static function LIGHT_BLUE_HARNESS() : Harness{
		if(!isset(self::$_mLIGHT_BLUE_HARNESS)){ self::init(); }
		return clone self::$_mLIGHT_BLUE_HARNESS;
	}

	public static function LIGHT_GRAY_BUNDLE() : Bundle{
		if(!isset(self::$_mLIGHT_GRAY_BUNDLE)){ self::init(); }
		return clone self::$_mLIGHT_GRAY_BUNDLE;
	}

	public static function LIGHT_GRAY_HARNESS() : Harness{
		if(!isset(self::$_mLIGHT_GRAY_HARNESS)){ self::init(); }
		return clone self::$_mLIGHT_GRAY_HARNESS;
	}

	public static function LIME_BUNDLE() : Bundle{
		if(!isset(self::$_mLIME_BUNDLE)){ self::init(); }
		return clone self::$_mLIME_BUNDLE;
	}

	public static function LIME_HARNESS() : Harness{
		if(!isset(self::$_mLIME_HARNESS)){ self::init(); }
		return clone self::$_mLIME_HARNESS;
	}

	public static function MACE() : Mace{
		if(!isset(self::$_mMACE)){ self::init(); }
		return clone self::$_mMACE;
	}

	public static function MAGENTA_BUNDLE() : Bundle{
		if(!isset(self::$_mMAGENTA_BUNDLE)){ self::init(); }
		return clone self::$_mMAGENTA_BUNDLE;
	}

	public static function MAGENTA_HARNESS() : Harness{
		if(!isset(self::$_mMAGENTA_HARNESS)){ self::init(); }
		return clone self::$_mMAGENTA_HARNESS;
	}

	public static function MANGROVE_CHEST_BOAT() : ChestBoat{
		if(!isset(self::$_mMANGROVE_CHEST_BOAT)){ self::init(); }
		return clone self::$_mMANGROVE_CHEST_BOAT;
	}

	public static function MINER_POTTERY_SHERD() : PotterySherd{
		if(!isset(self::$_mMINER_POTTERY_SHERD)){ self::init(); }
		return clone self::$_mMINER_POTTERY_SHERD;
	}

	public static function MOJANG_BANNER_PATTERN() : BannerPattern{
		if(!isset(self::$_mMOJANG_BANNER_PATTERN)){ self::init(); }
		return clone self::$_mMOJANG_BANNER_PATTERN;
	}

	public static function MOURNER_POTTERY_SHERD() : PotterySherd{
		if(!isset(self::$_mMOURNER_POTTERY_SHERD)){ self::init(); }
		return clone self::$_mMOURNER_POTTERY_SHERD;
	}

	public static function NETHERITE_HORSE_ARMOR() : HorseArmor{
		if(!isset(self::$_mNETHERITE_HORSE_ARMOR)){ self::init(); }
		return clone self::$_mNETHERITE_HORSE_ARMOR;
	}

	public static function NETHERITE_NAUTILUS_ARMOR() : NautilusArmor{
		if(!isset(self::$_mNETHERITE_NAUTILUS_ARMOR)){ self::init(); }
		return clone self::$_mNETHERITE_NAUTILUS_ARMOR;
	}

	public static function OAK_CHEST_BOAT() : ChestBoat{
		if(!isset(self::$_mOAK_CHEST_BOAT)){ self::init(); }
		return clone self::$_mOAK_CHEST_BOAT;
	}

	public static function OMINOUS_BOTTLE() : OminousBottle{
		if(!isset(self::$_mOMINOUS_BOTTLE)){ self::init(); }
		return clone self::$_mOMINOUS_BOTTLE;
	}

	public static function OMINOUS_TRIAL_KEY() : Item{
		if(!isset(self::$_mOMINOUS_TRIAL_KEY)){ self::init(); }
		return clone self::$_mOMINOUS_TRIAL_KEY;
	}

	public static function ORANGE_BUNDLE() : Bundle{
		if(!isset(self::$_mORANGE_BUNDLE)){ self::init(); }
		return clone self::$_mORANGE_BUNDLE;
	}

	public static function ORANGE_HARNESS() : Harness{
		if(!isset(self::$_mORANGE_HARNESS)){ self::init(); }
		return clone self::$_mORANGE_HARNESS;
	}

	public static function PIGLIN_BANNER_PATTERN() : BannerPattern{
		if(!isset(self::$_mPIGLIN_BANNER_PATTERN)){ self::init(); }
		return clone self::$_mPIGLIN_BANNER_PATTERN;
	}

	public static function PINK_BUNDLE() : Bundle{
		if(!isset(self::$_mPINK_BUNDLE)){ self::init(); }
		return clone self::$_mPINK_BUNDLE;
	}

	public static function PINK_HARNESS() : Harness{
		if(!isset(self::$_mPINK_HARNESS)){ self::init(); }
		return clone self::$_mPINK_HARNESS;
	}

	public static function PLENTY_POTTERY_SHERD() : PotterySherd{
		if(!isset(self::$_mPLENTY_POTTERY_SHERD)){ self::init(); }
		return clone self::$_mPLENTY_POTTERY_SHERD;
	}

	public static function POWDER_SNOW_BUCKET() : PowerSnowBucket{
		if(!isset(self::$_mPOWDER_SNOW_BUCKET)){ self::init(); }
		return clone self::$_mPOWDER_SNOW_BUCKET;
	}

	public static function PRIZE_POTTERY_SHERD() : PotterySherd{
		if(!isset(self::$_mPRIZE_POTTERY_SHERD)){ self::init(); }
		return clone self::$_mPRIZE_POTTERY_SHERD;
	}

	public static function PUFFERFISH_BUCKET() : LiquidBucket{
		if(!isset(self::$_mPUFFERFISH_BUCKET)){ self::init(); }
		return clone self::$_mPUFFERFISH_BUCKET;
	}

	public static function PURPLE_BUNDLE() : Bundle{
		if(!isset(self::$_mPURPLE_BUNDLE)){ self::init(); }
		return clone self::$_mPURPLE_BUNDLE;
	}

	public static function PURPLE_HARNESS() : Harness{
		if(!isset(self::$_mPURPLE_HARNESS)){ self::init(); }
		return clone self::$_mPURPLE_HARNESS;
	}

	public static function RED_BUNDLE() : Bundle{
		if(!isset(self::$_mRED_BUNDLE)){ self::init(); }
		return clone self::$_mRED_BUNDLE;
	}

	public static function RED_HARNESS() : Harness{
		if(!isset(self::$_mRED_HARNESS)){ self::init(); }
		return clone self::$_mRED_HARNESS;
	}

	public static function RHOMBUS_BANNER_PATTERN() : BannerPattern{
		if(!isset(self::$_mRHOMBUS_BANNER_PATTERN)){ self::init(); }
		return clone self::$_mRHOMBUS_BANNER_PATTERN;
	}

	public static function SADDLE() : Item{
		if(!isset(self::$_mSADDLE)){ self::init(); }
		return clone self::$_mSADDLE;
	}

	public static function SALMON_BUCKET() : LiquidBucket{
		if(!isset(self::$_mSALMON_BUCKET)){ self::init(); }
		return clone self::$_mSALMON_BUCKET;
	}

	public static function SCRAPE_POTTERY_SHERD() : PotterySherd{
		if(!isset(self::$_mSCRAPE_POTTERY_SHERD)){ self::init(); }
		return clone self::$_mSCRAPE_POTTERY_SHERD;
	}

	public static function SHEAF_POTTERY_SHERD() : PotterySherd{
		if(!isset(self::$_mSHEAF_POTTERY_SHERD)){ self::init(); }
		return clone self::$_mSHEAF_POTTERY_SHERD;
	}

	public static function SHELTER_POTTERY_SHERD() : PotterySherd{
		if(!isset(self::$_mSHELTER_POTTERY_SHERD)){ self::init(); }
		return clone self::$_mSHELTER_POTTERY_SHERD;
	}

	public static function SHIELD() : Shield{
		if(!isset(self::$_mSHIELD)){ self::init(); }
		return clone self::$_mSHIELD;
	}

	public static function SKULL_BANNER_PATTERN() : BannerPattern{
		if(!isset(self::$_mSKULL_BANNER_PATTERN)){ self::init(); }
		return clone self::$_mSKULL_BANNER_PATTERN;
	}

	public static function SKULL_POTTERY_SHERD() : PotterySherd{
		if(!isset(self::$_mSKULL_POTTERY_SHERD)){ self::init(); }
		return clone self::$_mSKULL_POTTERY_SHERD;
	}

	public static function SMALL_STRIPES_BANNER_PATTERN() : BannerPattern{
		if(!isset(self::$_mSMALL_STRIPES_BANNER_PATTERN)){ self::init(); }
		return clone self::$_mSMALL_STRIPES_BANNER_PATTERN;
	}

	public static function SNORT_POTTERY_SHERD() : PotterySherd{
		if(!isset(self::$_mSNORT_POTTERY_SHERD)){ self::init(); }
		return clone self::$_mSNORT_POTTERY_SHERD;
	}

	public static function SPRUCE_CHEST_BOAT() : ChestBoat{
		if(!isset(self::$_mSPRUCE_CHEST_BOAT)){ self::init(); }
		return clone self::$_mSPRUCE_CHEST_BOAT;
	}

	public static function SQUARE_BOTTOM_LEFT_BANNER_PATTERN() : BannerPattern{
		if(!isset(self::$_mSQUARE_BOTTOM_LEFT_BANNER_PATTERN)){ self::init(); }
		return clone self::$_mSQUARE_BOTTOM_LEFT_BANNER_PATTERN;
	}

	public static function SQUARE_BOTTOM_RIGHT_BANNER_PATTERN() : BannerPattern{
		if(!isset(self::$_mSQUARE_BOTTOM_RIGHT_BANNER_PATTERN)){ self::init(); }
		return clone self::$_mSQUARE_BOTTOM_RIGHT_BANNER_PATTERN;
	}

	public static function SQUARE_TOP_LEFT_BANNER_PATTERN() : BannerPattern{
		if(!isset(self::$_mSQUARE_TOP_LEFT_BANNER_PATTERN)){ self::init(); }
		return clone self::$_mSQUARE_TOP_LEFT_BANNER_PATTERN;
	}

	public static function SQUARE_TOP_RIGHT_BANNER_PATTERN() : BannerPattern{
		if(!isset(self::$_mSQUARE_TOP_RIGHT_BANNER_PATTERN)){ self::init(); }
		return clone self::$_mSQUARE_TOP_RIGHT_BANNER_PATTERN;
	}

	public static function STRAIGHT_CROSS_BANNER_PATTERN() : BannerPattern{
		if(!isset(self::$_mSTRAIGHT_CROSS_BANNER_PATTERN)){ self::init(); }
		return clone self::$_mSTRAIGHT_CROSS_BANNER_PATTERN;
	}

	public static function STRIPE_BOTTOM_BANNER_PATTERN() : BannerPattern{
		if(!isset(self::$_mSTRIPE_BOTTOM_BANNER_PATTERN)){ self::init(); }
		return clone self::$_mSTRIPE_BOTTOM_BANNER_PATTERN;
	}

	public static function STRIPE_CENTER_BANNER_PATTERN() : BannerPattern{
		if(!isset(self::$_mSTRIPE_CENTER_BANNER_PATTERN)){ self::init(); }
		return clone self::$_mSTRIPE_CENTER_BANNER_PATTERN;
	}

	public static function STRIPE_DOWNLEFT_BANNER_PATTERN() : BannerPattern{
		if(!isset(self::$_mSTRIPE_DOWNLEFT_BANNER_PATTERN)){ self::init(); }
		return clone self::$_mSTRIPE_DOWNLEFT_BANNER_PATTERN;
	}

	public static function STRIPE_DOWNRIGHT_BANNER_PATTERN() : BannerPattern{
		if(!isset(self::$_mSTRIPE_DOWNRIGHT_BANNER_PATTERN)){ self::init(); }
		return clone self::$_mSTRIPE_DOWNRIGHT_BANNER_PATTERN;
	}

	public static function STRIPE_LEFT_BANNER_PATTERN() : BannerPattern{
		if(!isset(self::$_mSTRIPE_LEFT_BANNER_PATTERN)){ self::init(); }
		return clone self::$_mSTRIPE_LEFT_BANNER_PATTERN;
	}

	public static function STRIPE_MIDDLE_BANNER_PATTERN() : BannerPattern{
		if(!isset(self::$_mSTRIPE_MIDDLE_BANNER_PATTERN)){ self::init(); }
		return clone self::$_mSTRIPE_MIDDLE_BANNER_PATTERN;
	}

	public static function STRIPE_RIGHT_BANNER_PATTERN() : BannerPattern{
		if(!isset(self::$_mSTRIPE_RIGHT_BANNER_PATTERN)){ self::init(); }
		return clone self::$_mSTRIPE_RIGHT_BANNER_PATTERN;
	}

	public static function STRIPE_TOP_BANNER_PATTERN() : BannerPattern{
		if(!isset(self::$_mSTRIPE_TOP_BANNER_PATTERN)){ self::init(); }
		return clone self::$_mSTRIPE_TOP_BANNER_PATTERN;
	}

	public static function TADPOLE_BUCKET() : LiquidBucket{
		if(!isset(self::$_mTADPOLE_BUCKET)){ self::init(); }
		return clone self::$_mTADPOLE_BUCKET;
	}

	public static function TRIAL_KEY() : Item{
		if(!isset(self::$_mTRIAL_KEY)){ self::init(); }
		return clone self::$_mTRIAL_KEY;
	}

	public static function TRIANGLES_BOTTOM_BANNER_PATTERN() : BannerPattern{
		if(!isset(self::$_mTRIANGLES_BOTTOM_BANNER_PATTERN)){ self::init(); }
		return clone self::$_mTRIANGLES_BOTTOM_BANNER_PATTERN;
	}

	public static function TRIANGLES_TOP_BANNER_PATTERN() : BannerPattern{
		if(!isset(self::$_mTRIANGLES_TOP_BANNER_PATTERN)){ self::init(); }
		return clone self::$_mTRIANGLES_TOP_BANNER_PATTERN;
	}

	public static function TRIANGLE_BOTTOM_BANNER_PATTERN() : BannerPattern{
		if(!isset(self::$_mTRIANGLE_BOTTOM_BANNER_PATTERN)){ self::init(); }
		return clone self::$_mTRIANGLE_BOTTOM_BANNER_PATTERN;
	}

	public static function TRIANGLE_TOP_BANNER_PATTERN() : BannerPattern{
		if(!isset(self::$_mTRIANGLE_TOP_BANNER_PATTERN)){ self::init(); }
		return clone self::$_mTRIANGLE_TOP_BANNER_PATTERN;
	}

	public static function TROPICAL_FISH_BUCKET() : LiquidBucket{
		if(!isset(self::$_mTROPICAL_FISH_BUCKET)){ self::init(); }
		return clone self::$_mTROPICAL_FISH_BUCKET;
	}

	public static function WARPED_FUNGUS_ON_A_STICK() : WarpedFungusOnAStick{
		if(!isset(self::$_mWARPED_FUNGUS_ON_A_STICK)){ self::init(); }
		return clone self::$_mWARPED_FUNGUS_ON_A_STICK;
	}

	public static function WHITE_BUNDLE() : Bundle{
		if(!isset(self::$_mWHITE_BUNDLE)){ self::init(); }
		return clone self::$_mWHITE_BUNDLE;
	}

	public static function WHITE_HARNESS() : Harness{
		if(!isset(self::$_mWHITE_HARNESS)){ self::init(); }
		return clone self::$_mWHITE_HARNESS;
	}

	public static function WIND_CHARGE() : WindCharge{
		if(!isset(self::$_mWIND_CHARGE)){ self::init(); }
		return clone self::$_mWIND_CHARGE;
	}

	public static function WOLF_ARMOR() : WolfArmor{
		if(!isset(self::$_mWOLF_ARMOR)){ self::init(); }
		return clone self::$_mWOLF_ARMOR;
	}

	public static function YELLOW_BUNDLE() : Bundle{
		if(!isset(self::$_mYELLOW_BUNDLE)){ self::init(); }
		return clone self::$_mYELLOW_BUNDLE;
	}

	public static function YELLOW_HARNESS() : Harness{
		if(!isset(self::$_mYELLOW_HARNESS)){ self::init(); }
		return clone self::$_mYELLOW_HARNESS;
	}
}
