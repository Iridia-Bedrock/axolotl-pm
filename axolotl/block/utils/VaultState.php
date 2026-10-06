<?php

namespace axolotl\block\utils;

enum VaultState{
	case INACTIVE;
	case ACTIVE;
	case UNLOCKING;
	case EJECTING;
}
