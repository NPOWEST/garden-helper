<?php

declare(strict_types = 1);

namespace Npowest\GardenHelper\Enum;

use Npowest\GardenHelper\Trait\EnumTrait;

enum ArhiveTypeEnum : string
{
	use EnumTrait;

	case a = 'a';

	case d = 'd';

	case h = 'h';

	case m = 'm';

	case w = 'w';
}//end enum
