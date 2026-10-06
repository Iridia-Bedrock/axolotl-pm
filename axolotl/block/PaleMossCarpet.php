<?php

namespace axolotl\block;

use axolotl\block\utils\PaleMossCarpetSide;

class PaleMossCarpet extends MossCarpet{

	/** @var PaleMossCarpetSide[] */
	private array $carpetSides = [];
	private bool $upperBit = false;

	public function getCarpetSide(int $facing) : PaleMossCarpetSide{
		return $this->carpetSides[$facing] ?? PaleMossCarpetSide::NONE;
	}

	public function setCarpetSide(int $facing, PaleMossCarpetSide $side) : void{
		$this->carpetSides[$facing] = $side;
	}

	public function isUpperBit() : bool{
		return $this->upperBit;
	}

	public function setUpperBit(bool $upperBit) : void{
		$this->upperBit = $upperBit;
	}
}
