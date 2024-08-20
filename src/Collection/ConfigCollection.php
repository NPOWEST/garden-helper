<?php

/**
 * @see https://npowest.ru
 * @license Shareware
 * @copyright (c) 2019-2024 NPOWest
 */

declare(strict_types=1);

namespace Npowest\GardenHelper\Collection;

use ArrayAccess;
use ArrayIterator;
use Countable;
use IteratorAggregate;
use Npowest\GardenHelper\Collection\Exception\{DeleteException, SetException};
use Npowest\GardenHelper\Enum\IndicatorEnum;

use function assert;
use function count;
use function is_array;
use function is_float;
use function is_int;
use function is_string;

/**
 * @implements ArrayAccess<int|string, ConfigCollection|float|IndicatorCollection|int|string>
 * @implements IteratorAggregate<int|string, ConfigCollection|float|IndicatorCollection|int|string>
 */
final class ConfigCollection implements ArrayAccess, Countable, IteratorAggregate
{
	/** @var array<int|string, ConfigCollection|float|IndicatorCollection|int|string> */
	private array $data = [];

	public function __clone()
	{
		foreach ($this->data as $key => $value)
		{
			if ($value instanceof self)
			{
				$this->data[$key] = clone $value;
			}
		}
	}//end __clone()

	/**
	 * Retrieves an ArrayIterator over the configuration values.
	 *
	 * @return ArrayIterator An iterator over all config data
	 */
	public function getIterator(): ArrayIterator
	{
		return new ArrayIterator($this->data);
	}//end getIterator()

	/**
	 * Checks if the specified config value exists.
	 */
	public function offsetExists(mixed $key): bool
	{
		return isset($this->data[$key]);
	}//end offsetExists()

	/**
	 * Retrieves a  value.
	 *
	 * @param int|string $key
	 *
	 * @return ConfigCollection|float|IndicatorCollection|int|string|null
	 */
	public function offsetGet(mixed $key): mixed
	{
		return $this->data[$key] ?? null;
	}//end offsetGet()

	/**
	 * @param int|string       $key
	 * @param float|int|string $value
	 *
	 * @throws SetException
	 */
	public function offsetSet(mixed $key, mixed $value): void
	{
		throw new SetException();
	}//end offsetSet()

	/**
	 * Called when deleting a  value directly, triggers an error.
	 *
	 * @throws DeleteException
	 */
	public function offsetUnset(mixed $key): void
	{
		throw new DeleteException();
	}//end offsetUnset()

	public function set(int|string $key, float|int|self|string $value): void
	{
		$this->data[$key] = $value;
	}//end set()

	public function setIndicator(IndicatorEnum $type, int $cnl, int $value): void
	{
		if (! isset($this->data['indicator']))
		{
			$this->data['indicator'] = new IndicatorCollection();
		}

		assert($this->data['indicator'] instanceof IndicatorCollection);
		$this->data['indicator']->set($type, $cnl, $value);
	}//end setIndicator()

	/**
	 * Retrieves the number of  options currently set.
	 *
	 * @return int Number of config options
	 */
	public function count(): int
	{
		return count($this->data);
	}//end count()

	public function empty(): bool
	{
		return empty($this->data);
	}//end empty()

	/**
	 * @return array<int|string, array<mixed>|float|int|string>
	 */
	public function toArray(): array
	{
		$data = [];
		foreach ($this->data as $key => $value)
		{
			if ($value instanceof self || $value instanceof IndicatorCollection)
			{
				$data[$key] = $value->toArray();

				continue;
			}

			$data[$key] = $value;
		}

		return $data;
	}//end toArray()

	/**
	 * @param array<mixed> $data [description]
	 */
	public function setFromArray(array $data): void
	{
		foreach ($data as $key => $value)
		{
			if (is_int($value) || is_float($value) || is_string($value))
			{
				$this->set($key, $value);

				continue;
			}

			if (is_array($value))
			{
				if ('indicator' == $key)
				{
					$this->data[$key] = new IndicatorCollection();
					$this->data[$key]->setFromArray($value);

					continue;
				}
				if (! isset($this->data[$key]) || ! ($this->data[$key] instanceof self))
				{
					$this->data[$key] = new self();
				}

				$this->data[$key]->setFromArray($value);
			}
		}//end foreach
	}//end setFromArray()

	public function setFromString(string $str): void
	{
		/** @var array<mixed>|null */
		$data = json_decode($str, true);
		if (! is_array($data))
		{
			return;
		}

		$this->setFromArray($data);
	}//end setFromString()

	public function merge(self $data): void
	{
		$this->setFromArray($data->toArray());
	}//end merge()
}//end class
