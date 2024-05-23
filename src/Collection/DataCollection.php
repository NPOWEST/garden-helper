<?php

declare(strict_types=1);

namespace Npowest\GardenHelper\Collection;

use function assert;
use function is_array;
use function is_string;

/**
 * archive data class.
 */
final class DataCollection extends AbstractCollection
{
	/** @var array<string, array<array<string, int|string>|int>> */
	protected array $error = [];

	/**
	 * @param array<mixed> $data
	 */
	public function setErrorFromArray(array $data): void
	{
		foreach ($data as $key => $values)
		{
			if (! is_string($key) || ! is_array($values))
			{
				continue;
			}

			/** @var array<string, int> */
			$msg    = [];
			$maxLvl = 0;

			foreach ($values as $value)
			{
				assert(is_string($value));
				$value  = explode('__', $value);
				$lvl    = (int) ($value[1] ?? 0);
				$maxLvl = max($maxLvl, $lvl);

				$msg[$value[0]] = $lvl;
			}

			$this->error[$key] = [
				'maxLvl' => $maxLvl,
				'msg'    => $msg,
			];
		}//end foreach
	}//end setErrorFromArray()

	public function setErrorFromString(string $str): void
	{
		/** @var array<mixed>|false */
		$error = json_decode($str, true);
		if (false === $error || ! isset($error['error']))
		{
			return;
		}

		assert(is_array($error['error']));
		$this->setErrorFromArray($error['error']);
	}//end setErrorFromString()

	public function getMaxLvl(string $key): int
	{
		/** @var int */
		return $this->error[$key]['maxLvl'] ?? 0;
	}//end getMaxLvl()

	/**
	 * @return list<string>
	 */
	public function getErrorTitle(string $key): array
	{
		if (! isset($this->error[$key]))
		{
			return [];
		}

		/** @var list<string> */
		return array_keys($this->error[$key]['msg']);
	}//end getErrorTitle()
}//end class
