<?php

/*
 *
 *  ____            _        _   __  __ _                  __  __ ____
 * |  _ \ ___   ___| | _____| |_|  \/  (_)_ __   ___      |  \/  |  _ \
 * | |_) / _ \ / __| |/ / _ \ __| |\/| | | '_ \ / _ \_____| |\/| | |_) |
 * |  __/ (_) | (__|   <  __/ |_| |  | | | | | |  __/_____| |  | |  __/
 * |_|   \___/ \___|_|\_\___|\__|_|  |_|_|_| |_|\___|     |_|  |_|_|
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author PocketMine Team
 * @link http://www.pocketmine.net/
 *
 *
 */

declare(strict_types=1);

namespace pocketmine\lang;

use InvalidArgumentException;
use pocketmine\utils\Utils;

final class Translatable{
	/** @var string[]|Translatable[] $params */
	protected array $params = [];

	/**
	 * @param (float|int|string|Translatable)[] $params
	 */
	public function __construct(
		protected string $text,
		array $params = []
	){
		foreach(Utils::promoteKeys($params) as $k => $param){
			if(!($param instanceof Translatable)){
				$this->params[$k] = (string) $param;
			}else{
				$this->params[$k] = $param;
			}
		}
	}

	public function getText() : string{
		return $this->text;
	}

	/**
	 * @return string[]|Translatable[]
	 */
	public function getParameters() : array{
		return $this->params;
	}

	public function getParameter(int|string $i) : Translatable|string|null{
		return $this->params[$i] ?? null;
	}

	public function format(string $before, string $after) : self{
		return new self("$before%$this->text$after", $this->params);
	}

	public function prefix(string $prefix) : self{
		return new self("$prefix%$this->text", $this->params);
	}

	public function postfix(string $postfix) : self{
		return new self("%$this->text" . $postfix);
	}

	/**
	 * @param Translatable $translatable
	 * @return array
	 */
	public static function serialize(Translatable $translatable): array
	{
		$parameters = [];
		foreach ($translatable->getParameters() as $k => $parameter) {
			if ($parameter instanceof Translatable) {
				$parameters[$k] = self::serialize($parameter);
			} else {
				$parameters[$k] = $parameter;
			}
		}

		return [
			'text' => $translatable->getText(),
			'parameters' => $parameters,
		];
	}

	/**
	 * @param array $data
	 * @return Translatable
	 * @throws InvalidArgumentException
	 */
	public static function deserialize(array $data): Translatable
	{
		if (!isset($data['text'])) {
			throw new InvalidArgumentException("Missing 'text' field in translation data structure.");
		}
		if (!is_string($data['text'])) {
			throw new InvalidArgumentException("The 'text' field in translation data must be a string.");
		}

		$text = $data['text'];
		$rawParameters = $data['parameters'] ?? [];

		if (!is_array($rawParameters)) {
			throw new InvalidArgumentException("The 'parameters' field in translation data must be an array.");
		}

		$parameters = [];
		foreach (Utils::promoteKeys($rawParameters) as $k => $param) {
			if (is_array($param)) {
				if (!isset($param['text'])) {
					throw new InvalidArgumentException("Nested translation parameter at key '{$k}' is missing the 'text' field.");
				}
				$parameters[$k] = self::deserialize($param);
			} else {
				if (is_object($param)) {
					throw new InvalidArgumentException("Invalid non-scalar parameter type at key '{$k}' in translation data.");
				}
				$parameters[$k] = $param;
			}
		}

		return new Translatable($text, $parameters);
	}
}
