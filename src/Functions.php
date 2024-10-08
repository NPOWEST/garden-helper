<?php

/**
 * @see https://npowest.ru
 * @license Shareware
 * @copyright (c) 2019-2024 NPOWest
 */

declare(strict_types=1);

namespace Npowest\GardenHelper;

final class Functions
{
	public static function between(float|int $value, float|int $lower, float|int $upper): bool
	{
		if ($lower > $upper)
		{
			[$lower, $upper] = [$upper, $lower];
		}

		return ($value >= $lower) && ($value <= $upper);
	}//end between()
}//end class
