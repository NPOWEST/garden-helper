<?php

/**
 * @see https://npowest.ru
 * @license Shareware
 * @copyright (c) 2019-2024 NPOWest
 */

declare(strict_types=1);

namespace Npowest\GardenHelper\Trait;

trait EnumTrait
{
	/**
	 * @return list<string>
	 */
	public static function names(): array
	{
		return array_column(self::cases(), 'name');
	}//end names()

	/**
	 * @return list<int|string>
	 */
	public static function values(): array
	{
		return array_column(self::cases(), 'value');
	}//end values()

	/**
	 * @return array<string, list|string>
	 */
	public static function array(): array
	{
		return array_combine(self::values(), self::names());
	}//end array()
}
