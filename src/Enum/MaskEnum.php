<?php

declare(strict_types=1);

namespace Npowest\GardenHelper\Enum;

use Npowest\GardenHelper\Trait\EnumTrait;

enum MaskEnum: int
{
	use EnumTrait;

	case p = 0;

	case n = 1;

	case c = 2;

	case d = 3;

	case h = 4;
}//end enum
