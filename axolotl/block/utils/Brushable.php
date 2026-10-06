<?php

namespace axolotl\block\utils;

interface Brushable{
	public function isHanging() : bool;

	public function setHanging(bool $hanging) : void;

	public function getProgress() : int;

	public function setProgress(int $progress) : void;
}
