<?php

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
	 * @param Item                    $item
	 * @param (string|Translatable)[] $lines
	 *
	 * @return Item
	 */
	public static function setLore(Item $item, array $lines) : Item{
		$processedLines = [];

		foreach($lines as $key => $line){
			if($line instanceof Translatable){
				$payload = [
					't' => $line->getText(),
					'p' => $line->getParameters()
				];
				$line = self::TRANSLATABLE_MARKER . json_encode($payload);
			}

			if(!is_string($line)){
				throw new TypeError("Expected string[] or Translatable[], but found " . gettype($line) . " at index $key");
			}

			Utils::checkUTF8($line);
			$processedLines[] = $line;
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

				if(is_array($data) && isset($data['t'], $data['p'])){
					$lore[$key] = new Translatable($data['t'], $data['p']);
				}else{
					$lore[$key] = new Translatable($payload);
				}
			}
		}

		return $lore;
	}
}