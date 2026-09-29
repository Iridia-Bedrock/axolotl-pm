<?php

declare(strict_types=1);

namespace axolotl;

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
}