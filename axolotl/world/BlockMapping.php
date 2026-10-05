<?php

declare(strict_types=1);

namespace axolotl\world;

use pocketmine\block\Block;

class BlockMapping{
	/**
	 * @var array<int, int> [originalStateId => spoofedStateId]
	 */
	private array $mappings = [];

	/** @var bool */
	private bool $dirty = false;

	/**
	 * @param Block $from
	 * @param Block $to
	 *
	 * @return $this
	 */
	public function add(Block $from, Block $to) : self{
		return $this->addById($from->getStateId(), $to->getStateId());
	}

	/**
	 * @param int $fromStateId
	 * @param int $toStateId
	 *
	 * @return $this
	 */
	public function addById(int $fromStateId, int $toStateId) : self{
		if(($this->mappings[$fromStateId] ?? null) !== $toStateId){
			$this->mappings[$fromStateId] = $toStateId;
			$this->dirty = true;
		}
		return $this;
	}

	/**
	 * @param Block $from
	 *
	 * @return $this
	 */
	public function remove(Block $from) : self{
		$stateId = $from->getStateId();
		if(isset($this->mappings[$stateId])){
			unset($this->mappings[$stateId]);
			$this->dirty = true;
		}
		return $this;
	}

	/**
	 * @param array<int, int> $mappings
	 *
	 * @return $this
	 */
	public function set(array $mappings) : self{
		$oldMappings = $this->mappings;
		$this->mappings = $mappings;
		if($oldMappings !== $mappings){
			$this->dirty = true;
		}
		return $this;
	}

	/**
	 * @param Block $block
	 *
	 * @return bool
	 */
	public function hasMapping(Block $block) : bool{
		return isset($this->mappings[$block->getStateId()]);
	}

	/**
	 * @param int $stateId
	 *
	 * @return int
	 */
	public function getMappedStateId(int $stateId) : int{
		return $this->mappings[$stateId] ?? $stateId;
	}

	/**
	 * @return $this
	 */
	public function clear() : self{
		if(!empty($this->mappings)){
			$this->mappings = [];
			$this->dirty = true;
		}
		return $this;
	}

	/**
	 * @return int[]
	 */
	public function toArray() : array{
		return $this->mappings;
	}

	/**
	 * @return bool
	 */
	public function isDirty() : bool{
		return $this->dirty;
	}

	/**
	 * @return void
	 */
	public function clearDirty() : void{
		$this->dirty = false;
	}
}