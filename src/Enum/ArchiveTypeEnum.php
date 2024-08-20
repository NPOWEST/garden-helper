<?php

/**
 * @see https://npowest.ru
 * @license Shareware
 * @copyright (c) 2019-2024 NPOWest
 */

declare(strict_types=1);

namespace Npowest\GardenHelper\Enum;

use Npowest\GardenHelper\Trait\EnumTrait;

enum ArchiveTypeEnum: string
{
	use EnumTrait;

	case a = 'a';

	case d = 'd';

	case D = 'D';

	case h = 'h';

	case H = 'H';

	case m = 'm';

	case w = 'w';
}//end enum
