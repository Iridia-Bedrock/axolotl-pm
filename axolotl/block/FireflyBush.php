<?php

namespace axolotl\block;

use pocketmine\block\Flowable;

final class FireflyBush extends Flowable{

	public function canBeReplaced() : bool{
		return true;
	}

	public function getLightLevel() : int{
		return 2;
	}
}
