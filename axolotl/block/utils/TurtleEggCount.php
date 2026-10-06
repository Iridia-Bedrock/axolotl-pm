<?php

namespace axolotl\block\utils;

use pocketmine\utils\LegacyEnumShimTrait;
use function array_search;
use function count;

/**
 * TODO: These tags need to be removed once we get rid of LegacyEnumShimTrait (PM6)
 *  These are retained for backwards compatibility only.
 *
 * @method static TurtleEggCount ONE_EGG()
 * @method static TurtleEggCount TWO_EGG()
 * @method static TurtleEggCount THREE_EGG()
 * @method static TurtleEggCount FOUR_EGG()
 */
enum TurtleEggCount{
	use LegacyEnumShimTrait;

	case ONE_EGG;
	case TWO_EGG;
	case THREE_EGG;
	case FOUR_EGG;

	public function before() : TurtleEggCount{
		$cases = self::cases();
		$index = array_search($this, $cases, true);

		return $cases[$index === 0 ? count($cases) - 1 : $index - 1];
	}

	public function next() : TurtleEggCount{
		$cases = self::cases();
		$index = array_search($this, $cases, true);

		return $cases[$index === count($cases) - 1 ? 0 : $index + 1];
	}
}
