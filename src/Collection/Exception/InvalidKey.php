<?php

/**
 * @see https://npowest.ru
 * @license Shareware
 * @copyright (c) 2019-2024 NPOWest
 */

declare(strict_types=1);

namespace Npowest\GardenHelper\Collection\Exception;

use Exception;

final class InvalidKey extends Exception
{
	public function __construct(string $key)
	{
		parent::__construct('Key must be '.$key);
	}//end __construct()
}//end class
