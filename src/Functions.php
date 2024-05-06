<?php

declare(strict_types = 1);

namespace Npowest\GardenHelper;

final class Functions
{
	public static function between(float|int $x, float|int $lower, float|int $upper) : bool
	{
		if ($lower > $upper)
		{
			[$lower, $upper] = [$upper, $lower];
		}

		return ($x >= $lower) && ($x <= $upper);
	}//end between()
}//end class
