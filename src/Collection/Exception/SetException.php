<?php

/**
 * @see https://npowest.ru
 * @license Shareware
 * @copyright (c) 2019-2024 NPOWest
 */

declare(strict_types=1);

namespace Npowest\GardenHelper\Collection\Exception;

use Exception;

final class SetException extends Exception
{
	public function __construct()
	{
		parent::__construct('Values have to be add explicitly with the set($key, $value) method.');
	}//end __construct()
}//end class
