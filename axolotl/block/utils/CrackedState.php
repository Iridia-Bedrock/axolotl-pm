<?php

namespace axolotl\block\utils;

use pocketmine\utils\LegacyEnumShimTrait;
use function array_search;
use function count;

/**
 * TODO: These tags need to be removed once we get rid of LegacyEnumShimTrait (PM6)
 *  These are retained for backwards compatibility only.
 *
 * @method static CrackedState NO_CRACKS()
 * @method static CrackedState CRACKED()
 * @method static CrackedState MAX_CRACKED()
 */
enum CrackedState{
	use LegacyEnumShimTrait;

	case NO_CRACKS;
	case CRACKED;
	case MAX_CRACKED;

	public function before() : CrackedState{
		$cases = self::cases();
		$index = array_search($this, $cases, true);

		return $cases[$index === 0 ? count($cases) - 1 : $index - 1];
	}

	public function next() : CrackedState{
		$cases = self::cases();
		$index = array_search($this, $cases, true);

		return $cases[$index === count($cases) - 1 ? 0 : $index + 1];
	}
}
