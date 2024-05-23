<?php

declare(strict_types=1);

namespace Npowest\GardenHelper\Collection;

use ArrayAccess;
use ArrayIterator;
use Countable;
use IteratorAggregate;
use Npowest\GardenHelper\Collection\Exception\{DeleteException, SetException};

use function count;
use function is_array;
use function is_float;
use function is_int;
use function is_string;

/**
 * @implements ArrayAccess<string|int, int|float|string|ConfigCollection>
 * @implements IteratorAggregate<string|int, int|float|string|ConfigCollection>
 */
final class ConfigCollection implements ArrayAccess, Countable, IteratorAggregate
{
	/** @var array<int|string, ConfigCollection|float|int|string> */
	private array $data = [];

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
		if (! is_int($key) && ! is_string($key))
		{
			return false;
		}

		return isset($this->data[$key]);
	}//end offsetExists()

	/**
	 * Retrieves a  value.
	 *
	 * @param int|string $key
	 *
	 * @return ConfigCollection|float|int|string|null
	 */
	public function offsetGet(mixed $key): mixed
	{
		return $this->data[$key] ?? null;
	}//end offsetGet()

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

	public function set(int|string $key, mixed $value): void
	{
		if (is_int($value) || is_float($value) || is_string($value) || $value instanceof self)
		{
			$this->data[$key] = $value;
		}
	}//end set()

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
			if ($value instanceof self)
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
				$this->data[$key] = $value;

				continue;
			}

			if (is_array($value))
			{
				if (! isset($this->data[$key]) || ! ($this->data[$key] instanceof self))
				{
					$this->data[$key] = new self();
				}

				$this->data[$key]->setFromArray($value);
			}
		}
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
