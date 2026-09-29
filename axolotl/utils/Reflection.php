<?php

namespace axolotl\utils;

use ReflectionClass;
use ReflectionException;
use ReflectionMethod;
use ReflectionProperty;

class Reflection{
	private static array $propCache = [];
	private static array $methCache = [];

	/**
	 * @param object      $source
	 * @param object      $target
	 * @param string|null $className
	 *
	 * @return void
	 */
	public static function copyProperties(object $source, object $target, ?string $className = null): void
	{
		$className ??= $source::class;

		try {
			$refClass = new ReflectionClass($className);
			foreach ($refClass->getProperties() as $refProp) {
				if ($refProp->isStatic()) {
					continue;
				}

				if (!$refProp->isInitialized($source)) {
					continue;
				}

				$value = $refProp->getValue($source);
				$refProp->setValue($target, $value);
			}
		} catch (ReflectionException $e) {
			// Ignore
		}
	}

	/**
	 * @param object|null $instance
	 * @param string      $key
	 * @param mixed       $value
	 * @param string|null $className
	 *
	 * @return void
	 */
	public static function put(?object $instance, string $key, mixed $value, ?string $className = null): void
	{
		$className ??= $instance::class;

		$refProp = self::getProperty($className, $key);
		$refProp?->setValue($instance, $value);
	}

	/**
	 * @param object|null $instance
	 * @param string      $key
	 * @param string|null $className
	 *
	 * @return mixed
	 */
	public static function tryGet(?object $instance, string $key, ?string $className = null): mixed
	{
		$className ??= $instance::class;

		$refProp = self::getProperty($className, $key);

		if ($refProp !== null && $instance !== null && !$refProp->isInitialized($instance)) {
			return null;
		}

		return $refProp?->getValue($instance);
	}

	/**
	 * @param string $className
	 * @param string $key
	 *
	 * @return ReflectionProperty|null
	 */
	private static function getProperty(string $className, string $key): ?ReflectionProperty
	{
		$cacheKey = "$className&$key";
		if (!isset(self::$propCache[$cacheKey])) {
			try {
				$refClass = new ReflectionClass($className);
				$refProp = $refClass->getProperty($key);
				self::$propCache[$cacheKey] = $refProp;
			} catch (ReflectionException $e) {
				return null;
			}
		}

		return self::$propCache[$cacheKey] ?? null;
	}

	/**
	 * @param string $className
	 * @param string $methodName
	 *
	 * @return ReflectionMethod|null
	 */
	public static function func(string $className, string $methodName): ?ReflectionMethod
	{
		return self::getMethod($className, $methodName);
	}

	/**
	 * @param string $className
	 * @param string $methodName
	 *
	 * @return ReflectionMethod|null
	 */
	private static function getMethod(string $className, string $methodName): ?ReflectionMethod
	{
		$cacheKey = "$className&$methodName";

		if (!isset(self::$methCache[$cacheKey])) {
			try {
				$refClass = new ReflectionClass($className);
				$refMeth = $refClass->getMethod($methodName);
				self::$methCache[$cacheKey] = $refMeth;
			} catch (ReflectionException $e) {
				return null;
			}
		}

		return self::$methCache[$cacheKey] ?? null;
	}
}