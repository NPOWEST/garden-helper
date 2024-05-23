<?php

declare(strict_types=1);

namespace Npowest\GardenHelper\Enum;

enum CurrentModeSaveEnum: string
{
	case full = 'full';

	case save = 'save';

	case tmp = 'tmp';
}//end enum
