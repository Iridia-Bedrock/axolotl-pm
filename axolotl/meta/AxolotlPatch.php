<?php

namespace axolotl\meta;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_CLASS | Attribute::TARGET_PROPERTY)]
class AxolotlPatch {
	public function __construct(
			public PatchType $type,
			public string $reason = "",
			public ?string $issueLink = null,
			public ?string $upstreamVersion = null
	) {}
}