<?php

declare(strict_types=1);

namespace axolotl;

use axolotl\block\AxolotlBlocks;
use axolotl\block\AxolotlBlocksInputs;
use axolotl\block\tile\AxolotlTileFactory;
use axolotl\entity\AxolotlEntityFactory;
use axolotl\item\AxolotlItems;
use axolotl\item\AxolotlItemsInputs;
use pocketmine\block\RuntimeBlockStateRegistry;
use pocketmine\VersionInfo;

final class Axolotl{
	public const NAME = VersionInfo::NAME;
	public const PATCH_VERSION = "1.0.0";

	/**
	 *
	 */
	private function __construct(){
		// NOOP
	}

	/**
	 * @return string
	 */
	public static function getPatchVersion() : string{
		return self::PATCH_VERSION;
	}

	/**
	 * @return string
	 */
	public static function getFullVersion() : string{
		return VersionInfo::BASE_VERSION . "-" . self::NAME . "-" . self::PATCH_VERSION;
	}

	/**
	 * @param string $minimumVersion
	 *
	 * @return bool
	 */
	public static function isPatchVersionAtLeast(string $minimumVersion) : bool{
		return version_compare(self::PATCH_VERSION, $minimumVersion, '>=');
	}

	public static function init() : void{
		AxolotlEntityFactory::getInstance(); // Ensure the entity factory is initialized
		AxolotlTileFactory::getInstance(); // Ensure the tile factory is initialized

		AxolotlBlocksInputs::delayed(); // Ensure all custom block inputs are registered
		AxolotlBlocks::getAll(); // Ensure all custom blocks are registered

		AxolotlItemsInputs::delayed(); // Ensure all custom item inputs are registered
		AxolotlItems::getAll(); // Ensure all custom items are registered

		foreach (AxolotlBlocks::getAll() as $block){
			RuntimeBlockStateRegistry::getInstance()->register($block);
		}
	}
}