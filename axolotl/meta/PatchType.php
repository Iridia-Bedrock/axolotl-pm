<?php

declare(strict_types=1);

namespace axolotl\meta;

enum PatchType {
	case OVERRIDE;
	case INJECTION;
	case ADDITION;
	case BUGFIX;
	case OPTIMIZATION;
}