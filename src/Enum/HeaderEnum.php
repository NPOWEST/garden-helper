<?php

declare(strict_types = 1);

namespace Npowest\GardenHelper\Enum;

use Npowest\GardenHelper\Trait\EnumTrait;

enum HeaderEnum : int
{
	use EnumTrait;

	case p = 0;

	case c = 1;

	case a = 2;
}//end enum
