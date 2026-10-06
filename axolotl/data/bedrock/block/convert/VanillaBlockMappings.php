<?php

namespace axolotl\data\bedrock\block\convert;

use axolotl\block\AxolotlBlocks as Blocks;
use axolotl\block\BeeHive;
use axolotl\block\BeeNest;
use axolotl\block\CommandBlock;
use axolotl\block\Composter;
use axolotl\block\CreakingHeart;
use axolotl\block\DriedGhast;
use axolotl\block\Grindstone;
use axolotl\block\Kelp;
use axolotl\block\PaleHangingMoss;
use axolotl\block\PaleMossCarpet;
use axolotl\block\PointedDripstone;
use axolotl\block\Scaffolding;
use axolotl\block\SculkCatalyst;
use axolotl\block\SculkSensor;
use axolotl\block\SculkShrieker;
use axolotl\block\SeaGrass;
use axolotl\block\SnifferEgg;
use axolotl\block\TrialSpawner;
use axolotl\block\TurtleEgg;
use axolotl\block\utils\Attachment;
use axolotl\block\utils\Brushable;
use axolotl\block\utils\CrackedState;
use axolotl\block\utils\CreakingHeartState;
use axolotl\block\utils\DripstoneThickness;
use axolotl\block\utils\PaleMossCarpetSide;
use axolotl\block\utils\SeaGrassType;
use axolotl\block\utils\TurtleEggCount;
use axolotl\block\utils\VaultState;
use axolotl\block\Vault;
use pocketmine\data\bedrock\block\BlockStateNames as StateNames;
use pocketmine\data\bedrock\block\BlockTypeNames as Ids;
use pocketmine\data\bedrock\block\convert\BlockSerializerDeserializerRegistrar;
use pocketmine\data\bedrock\block\convert\Model;
use pocketmine\data\bedrock\block\convert\property\BoolProperty;
use pocketmine\data\bedrock\block\convert\property\CommonProperties;
use pocketmine\data\bedrock\block\convert\property\EnumFromRawStateMap;
use pocketmine\data\bedrock\block\convert\property\IntProperty;
use pocketmine\data\bedrock\block\convert\property\ValueFromStringProperty;
use pocketmine\data\bedrock\block\convert\VanillaBlockMappings as VanillaBlockMappingsPM;
use pocketmine\math\Facing;

class VanillaBlockMappings extends VanillaBlockMappingsPM {
	public static function init(BlockSerializerDeserializerRegistrar $reg) : void{
		parent::init($reg);
		$commonProperties = CommonProperties::getInstance();
		$reg->mapModel(Model::create(Blocks::SEAGRASS(), Ids::SEAGRASS)->properties([
			new ValueFromStringProperty(StateNames::SEA_GRASS_TYPE, EnumFromRawStateMap::string(SeaGrassType::class, fn(SeaGrassType $type) => strtolower($type->name)), fn(SeaGrass $b) => $b->getType(), fn(SeaGrass $b, SeaGrassType $v) => $b->setType($v))
		]));
		$reg->mapModel(Model::create(Blocks::TURTLE_EGG(), Ids::TURTLE_EGG)->properties([
			new ValueFromStringProperty(StateNames::TURTLE_EGG_COUNT, EnumFromRawStateMap::string(TurtleEggCount::class, fn(TurtleEggCount $eggCount) => strtolower($eggCount->name)), fn(TurtleEgg $b) => $b->getEggs(), fn(TurtleEgg $b, TurtleEggCount $v) => $b->setEggs($v)),
			new ValueFromStringProperty(StateNames::CRACKED_STATE, EnumFromRawStateMap::string(CrackedState::class, fn(CrackedState $state) => strtolower($state->name)), fn(TurtleEgg $b) => $b->getCracks(), fn(TurtleEgg $b, CrackedState $v) => $b->setCracks($v))
		]));
		$reg->mapModel(Model::create(Blocks::COMMAND_BLOCK(), Ids::COMMAND_BLOCK)->properties([
			new BoolProperty(StateNames::CONDITIONAL_BIT, fn(CommandBlock $b) => $b->isConditional(), fn(CommandBlock $b, bool $v) => $b->setConditional($v)),
			new IntProperty(StateNames::FACING_DIRECTION, 0, 5, fn(CommandBlock $b) => $b->getFacing(), fn(CommandBlock $b, int $v) => $b->setFacing($v))
		]));
		$reg->mapModel(Model::create(Blocks::CHAIN_COMMAND_BLOCK(), Ids::CHAIN_COMMAND_BLOCK)->properties([
			new BoolProperty(StateNames::CONDITIONAL_BIT, fn(CommandBlock $b) => $b->isConditional(), fn(CommandBlock $b, bool $v) => $b->setConditional($v)),
			new IntProperty(StateNames::FACING_DIRECTION, 0, 5, fn(CommandBlock $b) => $b->getFacing(), fn(CommandBlock $b, int $v) => $b->setFacing($v))
		]));
		$reg->mapModel(Model::create(Blocks::REPEATING_COMMAND_BLOCK(), Ids::REPEATING_COMMAND_BLOCK)->properties([
			new BoolProperty(StateNames::CONDITIONAL_BIT, fn(CommandBlock $b) => $b->isConditional(), fn(CommandBlock $b, bool $v) => $b->setConditional($v)),
			new IntProperty(StateNames::FACING_DIRECTION, 0, 5, fn(CommandBlock $b) => $b->getFacing(), fn(CommandBlock $b, int $v) => $b->setFacing($v))
		]));
		$reg->mapModel(Model::create(Blocks::SCAFFOLDING(), Ids::SCAFFOLDING)->properties([
			new IntProperty(StateNames::STABILITY, 0, 7, fn(Scaffolding $b) => $b->getStability(), fn(Scaffolding $b, int $v) => $b->setStability($v)),
			new BoolProperty(StateNames::STABILITY_CHECK, fn(Scaffolding $b) => $b->isStabilityCheck(), fn(Scaffolding $b, bool $v) => $b->setStabilityCheck($v)),
		]));
		$reg->mapModel(Model::create(Blocks::SCULK_CATALYST(), Ids::SCULK_CATALYST)->properties([
			new BoolProperty(StateNames::BLOOM, fn(SculkCatalyst $b) => $b->isBloom(), fn(SculkCatalyst $b, bool $v) => $b->setBloom($v)),
		]));
		$reg->mapModel(Model::create(Blocks::SCULK_SENSOR(), Ids::SCULK_SENSOR)->properties([
			new IntProperty(StateNames::SCULK_SENSOR_PHASE, 0, 2, fn(SculkSensor $b) => $b->getPhase(), fn(SculkSensor $b, int $v) => $b->setPhase($v)),
		]));
		$reg->mapModel(Model::create(Blocks::CALIBRATED_SCULK_SENSOR(), Ids::CALIBRATED_SCULK_SENSOR)->properties([
			new IntProperty(StateNames::SCULK_SENSOR_PHASE, 0, 2, fn(SculkSensor $b) => $b->getPhase(), fn(SculkSensor $b, int $v) => $b->setPhase($v)),
		]));
		$reg->mapModel(Model::create(Blocks::SCULK_SHRIEKER(), Ids::SCULK_SHRIEKER)->properties([
			new BoolProperty(StateNames::ACTIVE, fn(SculkShrieker $b) => $b->isActive(), fn(SculkShrieker $b, bool $v) => $b->setActive($v)),
			new BoolProperty(StateNames::CAN_SUMMON, fn(SculkShrieker $b) => $b->canSummon(), fn(SculkShrieker $b, bool $v) => $b->setCanSummon($v)),
		]));
		$reg->mapModel(Model::create(Blocks::SCULK_VEIN(), Ids::SCULK_VEIN)->properties([
			$commonProperties->multiFacingFlags
		]));
		$reg->mapModel(Model::create(Blocks::LEAF_LITTER(), Ids::LEAF_LITTER)->properties([
			$commonProperties->horizontalFacingCardinal,
			$commonProperties->cropAgeMax7,
		]));

		$sideMossCarpet = function(string $state, int $facing) : ValueFromStringProperty {
			return new ValueFromStringProperty(
				$state,
				EnumFromRawStateMap::string(PaleMossCarpetSide::class, fn(PaleMossCarpetSide $orientation) => strtolower($orientation->name)),
				fn(PaleMossCarpet $b) => $b->getCarpetSide($facing),
				fn(PaleMossCarpet $b, PaleMossCarpetSide $v) => $b->setCarpetSide($facing, $v)
			);
		};
		$reg->mapModel(Model::create(Blocks::PALE_MOSS_CARPET(), Ids::PALE_MOSS_CARPET)->properties([
			$sideMossCarpet(StateNames::PALE_MOSS_CARPET_SIDE_EAST, Facing::EAST),
			$sideMossCarpet(StateNames::PALE_MOSS_CARPET_SIDE_NORTH, Facing::NORTH),
			$sideMossCarpet(StateNames::PALE_MOSS_CARPET_SIDE_SOUTH, Facing::SOUTH),
			$sideMossCarpet(StateNames::PALE_MOSS_CARPET_SIDE_WEST, Facing::WEST),
			new BoolProperty(StateNames::UPPER_BLOCK_BIT, fn(PaleMossCarpet $b) => $b->isUpperBit(), fn(PaleMossCarpet $b, bool $v) => $b->setUpperBit($v))
		]));
		$reg->mapModel(Model::create(Blocks::PALE_HANGING_MOSS(), Ids::PALE_HANGING_MOSS)->properties([
			new BoolProperty(StateNames::TIP, fn(PaleHangingMoss $b) => $b->isTip(), fn(PaleHangingMoss $b, bool $v) => $b->setTip($v))
		]));

		$reg->mapModel(Model::create(Blocks::SUSPICIOUS_SAND(), Ids::SUSPICIOUS_SAND)->properties([
			new BoolProperty(StateNames::HANGING, fn(Brushable $b) => $b->isHanging(), fn(Brushable $b, bool $v) => $b->setHanging($v)),
			new IntProperty(StateNames::BRUSHED_PROGRESS, 0, 3, fn(Brushable $b) => $b->getProgress(), fn(Brushable $b, int $v) => $b->setProgress($v)),
		]));
		$reg->mapModel(Model::create(Blocks::SUSPICIOUS_GRAVEL(), Ids::SUSPICIOUS_GRAVEL)->properties([
			new BoolProperty(StateNames::HANGING, fn(Brushable $b) => $b->isHanging(), fn(Brushable $b, bool $v) => $b->setHanging($v)),
			new IntProperty(StateNames::BRUSHED_PROGRESS, 0, 3, fn(Brushable $b) => $b->getProgress(), fn(Brushable $b, int $v) => $b->setProgress($v)),
		]));
		$reg->mapModel(Model::create(Blocks::KELP_BLOCK(), Ids::KELP)->properties([
			new IntProperty(StateNames::KELP_AGE, 0, 25, fn(Kelp $b) => $b->getAge(), fn(Kelp $b, int $v) => $b->setAge($v)),
		]));

		$reg->mapSimple(Blocks::MOSS_BLOCK(), Ids::MOSS_BLOCK);
		$reg->mapSimple(Blocks::MOSS_CARPET(), Ids::MOSS_CARPET);
		$reg->mapSimple(Blocks::TARGET(), Ids::TARGET);
		$reg->mapSimple(Blocks::HONEY_BLOCK(), Ids::HONEY_BLOCK);
		$reg->mapSimple(Blocks::POWDER_SNOW(), Ids::POWDER_SNOW);
		$reg->mapSimple(Blocks::SHORT_DRY_GRASS(), Ids::SHORT_DRY_GRASS);
		$reg->mapSimple(Blocks::TALL_DRY_GRASS(), Ids::TALL_DRY_GRASS);
		$reg->mapSimple(Blocks::BUSH(), Ids::BUSH);
		$reg->mapSimple(Blocks::CLOSED_EYEBLOSSOM(), Ids::CLOSED_EYEBLOSSOM);
		$reg->mapSimple(Blocks::OPEN_EYEBLOSSOM(), Ids::OPEN_EYEBLOSSOM);
		$reg->mapSimple(Blocks::WILDFLOWERS(), Ids::WILDFLOWERS);
		$reg->mapSimple(Blocks::PALE_MOSS_BLOCK(), Ids::PALE_MOSS_BLOCK);
		$reg->mapSimple(Blocks::FIREFLY_BUSH(), Ids::FIREFLY_BUSH);

		$reg->mapModel(Model::create(Blocks::COPPER_CHEST(), Ids::COPPER_CHEST)->properties([$commonProperties->horizontalFacingCardinal]));
		$reg->mapModel(Model::create(Blocks::EXPOSED_COPPER_CHEST(), Ids::EXPOSED_COPPER_CHEST)->properties([$commonProperties->horizontalFacingCardinal]));
		$reg->mapModel(Model::create(Blocks::WEATHERED_COPPER_CHEST(), Ids::WEATHERED_COPPER_CHEST)->properties([$commonProperties->horizontalFacingCardinal]));
		$reg->mapModel(Model::create(Blocks::OXIDISED_COPPER_CHEST(), Ids::OXIDIZED_COPPER_CHEST)->properties([$commonProperties->horizontalFacingCardinal]));
		$reg->mapModel(Model::create(Blocks::WAXED_COPPER_CHEST(), Ids::WAXED_COPPER_CHEST)->properties([$commonProperties->horizontalFacingCardinal]));
		$reg->mapModel(Model::create(Blocks::WAXED_EXPOSED_COPPER_CHEST(), Ids::WAXED_EXPOSED_COPPER_CHEST)->properties([$commonProperties->horizontalFacingCardinal]));
		$reg->mapModel(Model::create(Blocks::WAXED_WEATHERED_COPPER_CHEST(), Ids::WAXED_WEATHERED_COPPER_CHEST)->properties([$commonProperties->horizontalFacingCardinal]));
		$reg->mapModel(Model::create(Blocks::WAXED_OXIDISED_COPPER_CHEST(), Ids::WAXED_OXIDIZED_COPPER_CHEST)->properties([$commonProperties->horizontalFacingCardinal]));

		$reg->mapSimple(Blocks::DEAD_TUBE_CORAL_BLOCK(), Ids::DEAD_TUBE_CORAL_BLOCK);
		$reg->mapSimple(Blocks::DEAD_BRAIN_CORAL_BLOCK(), Ids::DEAD_BRAIN_CORAL_BLOCK);
		$reg->mapSimple(Blocks::DEAD_BUBBLE_CORAL_BLOCK(), Ids::DEAD_BUBBLE_CORAL_BLOCK);
		$reg->mapSimple(Blocks::DEAD_FIRE_CORAL_BLOCK(), Ids::DEAD_FIRE_CORAL_BLOCK);
		$reg->mapSimple(Blocks::DEAD_HORN_CORAL_BLOCK(), Ids::DEAD_HORN_CORAL_BLOCK);

		$reg->mapSimple(Blocks::DEAD_TUBE_CORAL(), Ids::DEAD_TUBE_CORAL);
		$reg->mapSimple(Blocks::DEAD_BRAIN_CORAL(), Ids::DEAD_BRAIN_CORAL);
		$reg->mapSimple(Blocks::DEAD_BUBBLE_CORAL(), Ids::DEAD_BUBBLE_CORAL);
		$reg->mapSimple(Blocks::DEAD_FIRE_CORAL(), Ids::DEAD_FIRE_CORAL);
		$reg->mapSimple(Blocks::DEAD_HORN_CORAL(), Ids::DEAD_HORN_CORAL);

		$reg->mapSimple(Blocks::GOLDEN_DANDELION(), Ids::GOLDEN_DANDELION);

		$reg->mapModel(Model::create(Blocks::BEEHIVE(), Ids::BEEHIVE)->properties([
			$commonProperties->horizontalFacingSWNE,
			new IntProperty(StateNames::HONEY_LEVEL, 0, 5, fn(BeeHive $b) => $b->getHoneyLevel(), fn(BeeHive $b, int $v) => $b->setHoneyLevel($v))
		]));
		$reg->mapModel(Model::create(Blocks::BEE_NEST(), Ids::BEE_NEST)->properties([
			$commonProperties->horizontalFacingSWNE,
			new IntProperty(StateNames::HONEY_LEVEL, 0, 5, fn(BeeNest $b) => $b->getHoneyLevel(), fn(BeeNest $b, int $v) => $b->setHoneyLevel($v))
		]));

		$reg->mapSimple(Blocks::LODESTONE(), Ids::LODESTONE);
		$reg->mapModel(Model::create(Blocks::GRINDSTONE(), Ids::GRINDSTONE)->properties([
			$commonProperties->horizontalFacingSWNE,
			new ValueFromStringProperty(StateNames::ATTACHMENT, EnumFromRawStateMap::string(Attachment::class, fn(Attachment $state) => strtolower($state->name)), fn(Grindstone $b) => $b->getAttachment(), fn(Grindstone $b, Attachment $v) => $b->setAttachment($v))
		]));
		$reg->mapModel(Model::create(Blocks::COMPOSTER(), Ids::COMPOSTER)->properties([
			new IntProperty(StateNames::COMPOSTER_FILL_LEVEL, 0, 8, fn(Composter $b) => $b->getFillLevel(), fn(Composter $b, int $v) => $b->setFillLevel($v))
		]));

		$reg->mapModel(Model::create(Blocks::COPPER_GOLEM_STATUE(), Ids::COPPER_GOLEM_STATUE)->properties([$commonProperties->horizontalFacingCardinal]));
		$reg->mapModel(Model::create(Blocks::EXPOSED_COPPER_GOLEM_STATUE(), Ids::EXPOSED_COPPER_GOLEM_STATUE)->properties([$commonProperties->horizontalFacingCardinal]));
		$reg->mapModel(Model::create(Blocks::WEATHERED_COPPER_GOLEM_STATUE(), Ids::WEATHERED_COPPER_GOLEM_STATUE)->properties([$commonProperties->horizontalFacingCardinal]));
		$reg->mapModel(Model::create(Blocks::OXIDISED_COPPER_GOLEM_STATUE(), Ids::OXIDIZED_COPPER_GOLEM_STATUE)->properties([$commonProperties->horizontalFacingCardinal]));
		$reg->mapModel(Model::create(Blocks::WAXED_COPPER_GOLEM_STATUE(), Ids::WAXED_COPPER_GOLEM_STATUE)->properties([$commonProperties->horizontalFacingCardinal]));
		$reg->mapModel(Model::create(Blocks::WAXED_EXPOSED_COPPER_GOLEM_STATUE(), Ids::WAXED_EXPOSED_COPPER_GOLEM_STATUE)->properties([$commonProperties->horizontalFacingCardinal]));
		$reg->mapModel(Model::create(Blocks::WAXED_WEATHERED_COPPER_GOLEM_STATUE(), Ids::WAXED_WEATHERED_COPPER_GOLEM_STATUE)->properties([$commonProperties->horizontalFacingCardinal]));
		$reg->mapModel(Model::create(Blocks::WAXED_OXIDISED_COPPER_GOLEM_STATUE(), Ids::WAXED_OXIDIZED_COPPER_GOLEM_STATUE)->properties([$commonProperties->horizontalFacingCardinal]));

		$reg->mapSimple(Blocks::CONDUIT(), Ids::CONDUIT);

		$reg->mapModel(Model::create(Blocks::DECORATED_POT(), Ids::DECORATED_POT)->properties([
			$commonProperties->horizontalFacingSWNE
		]));
		$reg->mapModel(Model::create(Blocks::POINTED_DRIPSTONE(), Ids::POINTED_DRIPSTONE)->properties([
			new ValueFromStringProperty(
				StateNames::DRIPSTONE_THICKNESS,
				EnumFromRawStateMap::string(DripstoneThickness::class, fn(DripstoneThickness $orientation) => strtolower($orientation->name)),
				fn(PointedDripstone $b) => $b->getThickness(),
				fn(PointedDripstone $b, DripstoneThickness $v) => $b->setThickness($v)
			),
			new BoolProperty(StateNames::HANGING, fn(PointedDripstone $b) => $b->isHanging(), fn(PointedDripstone $b, bool $v) => $b->setHanging($v)),
		]));
		$reg->mapSimple(Blocks::DRIPSTONE_BLOCK(), Ids::DRIPSTONE_BLOCK);
		$reg->mapModel(Model::create(Blocks::TRIAL_SPAWNER(), Ids::TRIAL_SPAWNER)->properties([
			new BoolProperty(StateNames::OMINOUS, fn(TrialSpawner $b) => $b->isOminous(), fn(TrialSpawner $b, bool $v) => $b->setOminous($v)),
			new IntProperty(StateNames::TRIAL_SPAWNER_STATE, 0, 5, fn(TrialSpawner $b) => $b->getState(), fn(TrialSpawner $b, int $v) => $b->setState($v)),
		]));
		$reg->mapModel(Model::create(Blocks::VAULT(), Ids::VAULT)->properties([
			$commonProperties->horizontalFacingCardinal,
			new ValueFromStringProperty(
				StateNames::VAULT_STATE,
				EnumFromRawStateMap::string(VaultState::class, fn(VaultState $orientation) => strtolower($orientation->name)),
				fn(Vault $b) => $b->getState(),
				fn(Vault $b, VaultState $v) => $b->setState($v)
			),
			new BoolProperty(StateNames::OMINOUS, fn(Vault $b) => $b->isOminous(), fn(Vault $b, bool $v) => $b->setOminous($v)),
		]));
		$reg->mapModel(Model::create(Blocks::DRIED_GHAST(), Ids::DRIED_GHAST)->properties([
			$commonProperties->horizontalFacingCardinal,
			new IntProperty(StateNames::REHYDRATION_LEVEL, 0, 3, fn(DriedGhast $b) => $b->getHydratationLevel(), fn(DriedGhast $b, int $v) => $b->setHydratationLevel($v)),
		]));
		$reg->mapModel(Model::create(Blocks::SNIFFER_EGG(), Ids::SNIFFER_EGG)->properties([
			new ValueFromStringProperty(StateNames::CRACKED_STATE, EnumFromRawStateMap::string(CrackedState::class, fn(CrackedState $state) => strtolower($state->name)), fn(SnifferEgg $b) => $b->getCracks(), fn(SnifferEgg $b, CrackedState $v) => $b->setCracks($v))
		]));
		$reg->mapSimple(Blocks::FROG_SPAWN(), Ids::FROG_SPAWN);
		$reg->mapModel(Model::create(Blocks::CREAKING_HEART(), Ids::CREAKING_HEART)->properties([
			$commonProperties->pillarAxis,
			new BoolProperty(StateNames::NATURAL, fn(CreakingHeart $b) => $b->isNatural(), fn(CreakingHeart $b, bool $v) => $b->setNatural($v)),
			new ValueFromStringProperty(StateNames::CREAKING_HEART_STATE, EnumFromRawStateMap::string(CreakingHeartState::class, fn(CreakingHeartState $state) => strtolower($state->name)), fn(CreakingHeart $b) => $b->getCreakingHeartState(), fn(CreakingHeart $b, CreakingHeartState $v) => $b->setCreakingHeartState($v))
		]));

		/*foreach(DyeColor::cases() as $color){
			$idName = fn(string $suffix) => strtolower($color->name) . "_$suffix";

			$reg->mapStairs(Blocks::{$color->name . "_WOOL_STAIRS"}(), "minecraft:" . $idName('wool_stairs'));
			$reg->mapSlab(Blocks::{$color->name . "_WOOL_SLAB"}(), $idName('wool'));
			$reg->mapStairs(Blocks::{$color->name . "_CONCRETE_STAIRS"}(), "minecraft:" . $idName('concrete_stairs'));
			$reg->mapSlab(Blocks::{$color->name . "_CONCRETE_SLAB"}(), $idName('concrete'));
		}*/
	}
}