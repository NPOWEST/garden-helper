<?php

declare(strict_types=1);

namespace Npowest\GardenHelper;

use Npowest\GardenHelper\Enum\MaskEnum;

use function in_array;
use function is_string;

final class Mask
{
	/** @var string MaskEnum[5] */
	private string $mask;

	public function __construct(?string $mask)
	{
		$mask = is_string($mask) ? $mask : '';

		$this->mask = mb_str_pad(mb_substr($mask, 0, 5), 5, MaskEnum::n->name);

		$maskEnum = MaskEnum::names();
		for ($i = 0; $i < 5; ++$i)
		{
			if (! in_array($this->mask[$i], $maskEnum))
			{
				$this->mask[$i] = MaskEnum::n->name;
			}
		}
	}//end __construct()

	public function get(): string
	{
		return $this->mask;
	}//end get()

	public function is(MaskEnum $type): bool
	{
		return mb_strtolower($this->mask[$type->value]) === $type->name;
	}//end is()

	public function notOrder(): bool
	{
		return ctype_lower($this->mask);
	}//end notOrder()

	public function isRead(MaskEnum $type): bool
	{
		return $this->mask[$type->value] === mb_strtoupper($type->name);
	}//end isRead()

	public function del(MaskEnum $type): void
	{
		if (MaskEnum::n === $type)
		{
			return;
		}

		$this->mask[$type->value] = MaskEnum::n->name;
	}//end del()
}//end class
