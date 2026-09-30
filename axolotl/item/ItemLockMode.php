<?php

namespace axolotl\item;

enum ItemLockMode: int
{
	case NONE = 0;
	case LOCK_IN_SLOT = 1;
	case LOCK_IN_INVENTORY = 2;
}