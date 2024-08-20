<?php

/**
 * @see https://npowest.ru
 * @license Shareware
 * @copyright (c) 2019-2024 NPOWest
 */

declare(strict_types=1);

namespace Npowest\GardenHelper\Enum;

use Npowest\GardenHelper\Trait\EnumTrait;

enum ArchiveTypeSaveEnum: string
{
	use EnumTrait;

	case s = 's';

	case n = 'n';

	case w = 'w';

	case iD = 'iD';

	case iH = 'iH';

	case wD = 'wD';

	case wH = 'wH';
}//end enum
