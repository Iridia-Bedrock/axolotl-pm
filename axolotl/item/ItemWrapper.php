<?php

declare(strict_types=1);

/**
 * This file is part of the Iridia Core package.
 *
 * (c) Iridia Project <https://github.com/Iridia-Bedrock>
 *
 * @author Zwuiix <https://github.com/Zwuiix-cmd>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * This project is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

namespace axolotl\item;

use pocketmine\item\Item;
use pocketmine\lang\Translatable;
use pocketmine\utils\Utils;
use TypeError;

class ItemWrapper{
	private const TRANSLATABLE_MARKER = "\x00ax_tr\x00";

	private function __construct(){
		// NOOP
	}

	/**
	 * @param Item                     $item
	 * @param string|Translatable|null $name
	 *
	 * @return Item
	 */
	public static function setCustomName(Item $item, string|Translatable|null $name) : Item{
		if($name instanceof Translatable){
			$name = self::TRANSLATABLE_MARKER . json_encode(Translatable::serialize($name));
		}

		if($name !== null){
			Utils::checkUTF8($name);
		}

		return $item->setCustomName($name);
	}

	/**
	 * @param Item $item
	 *
	 * @return string|Translatable|null
	 */
	public static function getCustomName(Item $item) : string|Translatable|null{
		$name = $item->getCustomName();

		if(str_starts_with($name, self::TRANSLATABLE_MARKER)){
			$payload = substr($name, strlen(self::TRANSLATABLE_MARKER));
			$data = json_decode($payload, true);

			if(is_array($data) && isset($data['text'])){
				return Translatable::deserialize($data);
			}
			return new Translatable($payload);
		}

		return $name;
	}

	/**
	 * @param Item                    $item
	 * @param (string|Translatable)[] $lines
	 *
	 * @return Item
	 */
	public static function setLore(Item $item, array $lines) : Item{
		$processedLines = [];

		foreach($lines as $key => $line){
			if($line instanceof Translatable){
				$line = self::TRANSLATABLE_MARKER . json_encode(Translatable::serialize($line));
			}

			if(!is_string($line)){
				throw new TypeError("Expected string[] or Translatable[], but found " . gettype($line) . " at index $key");
			}

			Utils::checkUTF8($line);
			$processedLines[$key] = $line;
		}

		return $item->setLore($processedLines);
	}

	/**
	 * @param Item $item
	 *
	 * @return (string|Translatable)[]
	 */
	public static function getLore(Item $item) : array{
		$lore = $item->getLore();

		foreach($lore as $key => $line){
			if(str_starts_with($line, self::TRANSLATABLE_MARKER)){
				$payload = substr($line, strlen(self::TRANSLATABLE_MARKER));
				$data = json_decode($payload, true);

				if(is_array($data) && isset($data['text'])){
					$lore[$key] = Translatable::deserialize($data);
				}else{
					$lore[$key] = new Translatable($payload);
				}
			}
		}

		return $lore;
	}

	/**
	 * @param Item $item
	 *
	 * @return bool
	 */
	public static function isFoil(Item $item) : bool{
		$namedTag = $item->getNamedTag();
		return $namedTag->getByte("foil", 0) === 1;
	}

	/**
	 * @param Item $item
	 * @param bool $foil
	 *
	 * @return Item
	 */
	public static function setFoil(Item $item, bool $foil) : Item{
		$namedTag = $item->getNamedTag();
		if($foil){
			$namedTag->setByte("foil", 1);
		}else{
			$namedTag->removeTag("foil");
		}
		return $item->setNamedTag($namedTag);
	}
}