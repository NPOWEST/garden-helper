<?php

declare(strict_types = 1);

namespace npowest\garden\device\enum;

enum current_mode : string
{
	case full = 'full';

	case save = 'save';

	case tmp = 'tmp';
}//end enum
