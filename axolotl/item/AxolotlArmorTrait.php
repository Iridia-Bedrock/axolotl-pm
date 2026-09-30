<?php

namespace axolotl\item;

use pocketmine\item\Armor;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\nbt\tag\StringTag;

trait AxolotlArmorTrait{
	public const TAG_TRIM = "Trim"; //TAG_Compound
	public const TAG_TRIM_MATERIAL = "Material"; //TAG_String
	public const TAG_TRIM_PATTERN = "Pattern"; //TAG_String

	protected ?Trim $trim = null;

	/**
	 * @return Trim|null
	 */
	public function getTrim() : ?Trim{
		return $this->trim;
	}

	/**
	 * @param Trim|null $trim
	 *
	 * @return Armor
	 */
	public function setTrim(?Trim $trim) : Armor{
		$this->trim = $trim;
		return $this;
	}

	/**
	 * @return Armor
	 */
	public function clearTrim() : Armor{
		$this->trim = null;
		return $this;
	}

	protected function axolotlDeserializeCompoundTag(CompoundTag $tag) : void{
		$this->trim = null;

		$trimTag = $tag->getTag(self::TAG_TRIM);
		if($trimTag instanceof CompoundTag){
			$materialTag = $trimTag->getTag(self::TAG_TRIM_MATERIAL);
			$patternTag = $trimTag->getTag(self::TAG_TRIM_PATTERN);
			if ($materialTag instanceof StringTag && $patternTag instanceof StringTag){
				$this->trim = new Trim($materialTag->getValue(), $patternTag->getValue());
			}
		}
	}

	protected function axolotlSerializeCompoundTag(CompoundTag $tag) : void{
		if($this->trim !== null){
			$tag->setTag(
				self::TAG_TRIM,
				CompoundTag::create()
					->setString(self::TAG_TRIM_MATERIAL, $this->trim->getMaterial())
					->setString(self::TAG_TRIM_PATTERN, $this->trim->getPattern())
			);
		}else{
			$tag->removeTag(self::TAG_TRIM);
		}
	}
}