<?php

declare(strict_types=1);

namespace axolotl\player;

use axolotl\meta\AxolotlPatch;
use axolotl\meta\PatchType;
use axolotl\world\BlockMapping;

trait AxolotlBlockMappingTrait{
	private ?BlockMapping $blockMapping = null;

	/**
	 * @return BlockMapping
	 */
	#[AxolotlPatch(
		type: PatchType::ADDITION,
		reason: "Provides lazy initialization and access to the player's personal BlockMapping instance for chunk spoofing.",
		upstreamVersion: "5.49.2"
	)]
	public function getBlockMapping() : BlockMapping{
		return $this->blockMapping ??= new BlockMapping();
	}
}