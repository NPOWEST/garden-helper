<?php

declare(strict_types = 1);

namespace Npowest\GardenHelper\Enum;

use Npowest\GardenHelper\Trait\EnumTrait;

enum IndicatorEnum : string
{
	case t = 't';

	case p = 'p';

	case v = 'v';

	case m = 'm';

	case g = 'g';
}//end enum
