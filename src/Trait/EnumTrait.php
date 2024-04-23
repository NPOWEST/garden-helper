<?php

declare(strict_types = 1);

namespace npowest\garden\device\enum;

trait to_array
{
	public static function names() : array
	{
		return array_column(self::cases(), 'name');
	}//end names()

	public static function values() : array
	{
		return array_column(self::cases(), 'value');
	}//end values()

	public static function array() : array
	{
		return array_combine(self::values(), self::names());
	}//end array()
}
