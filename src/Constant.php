<?php

declare(strict_types = 1);

namespace Npowest\GardenHelper;

final class Constant
{
	public const MINUTE = 60;

	public const MINUTE_FIVE = 300;

	public const HALFHOUR = 1_800;

	public const HOUR = 3_600;

	public const HALFDAY = 43_200;

	public const DAY = 86_400;

	public const DAY_MINUTE = 1_440;

	public const WEEK = 604_800;

	public const MONTH = 2_592_000;

	public const YEAR = 31_536_000;

	public const TYPE_NULL = -1;

	public const TYPE_HEAT = 0;

	public const TYPE_CONTR = 1;

	public const TYPE_ELEC = 2;

	public const TYPE_3 = 3;

	public const TYPE_WATER = 4;
}//end class
