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
use Npowest\GardenHelper\Collection\Exception\{DeleteException,InvalidKey, InvalidValue};

use function assert;
use function count;
use function is_array;
use function is_int;

/**
 * @implements ArrayAccess<int, DataCollection>
 * @implements IteratorAggregate<int, DataCollection>
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
final class ListCollection implements ArrayAccess, Countable, IteratorAggregate
{
	/** @var array<int, DataCollection> */
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
	 *
	 * @param int $key
	 *
	 * @throws InvalidKey
	 */
	public function offsetExists(mixed $key): bool
	{
		if (! is_int($key))
		{
			throw new InvalidKey('int');
		}

		return isset($this->data[$key]);
	}//end offsetExists()

	/**
	 * Retrieves a  value.
	 *
	 * @throws InvalidKey
	 */
	public function offsetGet(mixed $key): mixed
	{
		if (! is_int($key))
		{
			throw new InvalidKey('int');
		}

		return $this->data[$key] ?? new DataCollection();
	}//end offsetGet()

	/**
	 * Temporarily overwrites the value of a  variable.
	 *
	 * The  change will not persist. It will be lost
	 * after the request.
	 *
	 * @throws InvalidKey
	 * @throws InvalidValue
	 */
	public function offsetSet(mixed $key, mixed $value): void
	{
		if (! is_int($key))
		{
			throw new InvalidKey('int');
		}

		if (! ($value instanceof DataCollection))
		{
			throw new InvalidValue('DataCollection');
		}

		$this->data[$key] = $value;
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

	/**
	 * Retrieves the number of  options currently set.
	 *
	 * @return int Number of config options
	 */
	public function count(): int
	{
		return count($this->data);
	}//end count()

	public function empty(int $cnl = 0): bool
	{
		return ! isset($this->data[$cnl]) || $this->data[$cnl]->empty();
	}//end empty()

	/**
	 * @return array<int, array<string, float|int|string>>
	 */
	public function toArray(): array
	{
		$data  = [];
		$count = count($this->data);
		for ($cnl = 0; $cnl < $count; ++$cnl)
		{
			$data[$cnl] = $this->data[$cnl]->toArray();
		}

		return $data;
	}//end toArray()

	public function clear(): void
	{
		$this->data = [];
	}//end clear()

	public function add(DataCollection $data, int $cnl = 0): void
	{
		if (! isset($this->data[$cnl]))
		{
			$this->data[$cnl] = new DataCollection();
		}

		$this->data[$cnl]->merge($data);
	}//end add()

	public function delete(int $cnl): void
	{
		if (! isset($this->data[$cnl]))
		{
			return;
		}
		unset($this->data[$cnl]);
	}//end delete()

	public function set(string $key, mixed $value, int $cnl = 0): void
	{
		if (! isset($this->data[$cnl]))
		{
			$this->data[$cnl] = new DataCollection();
		}

		$this->data[$cnl]->set($key, $value);
	}//end set()

	/**
	 * @param array<mixed> $data [description]
	 */
	public function setFromArray(array $data, int $cnl = 0): void
	{
		if (! isset($this->data[$cnl]))
		{
			$this->data[$cnl] = new DataCollection();
		}

		$this->data[$cnl]->setFromArray($data);
	}//end setFromArray()

	public function overlay(self $data): void
	{
		foreach ($this->data as $cnl => $oldData)
		{
			if (! isset($data[$cnl]))
			{
				continue;
			}

			$this->data[$cnl]->overlay($data[$cnl]);
			$data->delete($cnl);
		}

		if (! count($data))
		{
			return;
		}

		foreach ($data as $cnl => $newData)
		{
			assert($newData instanceof DataCollection);
			$this->add($newData, $cnl);
		}
	}//end overlay()

	/**
	 * @param array<int, mixed> $data [description]
	 */
	public function overlayArray(array $data): void
	{
		foreach ($this->data as $cnl => $oldData)
		{
			if (! isset($data[$cnl]) || ! is_array($data[$cnl]))
			{
				continue;
			}

			$this->data[$cnl] = new DataCollection();
			$this->setFromArray($data[$cnl], $cnl);
			$this->setFromArray($oldData->toArray(), $cnl);
			unset($data[$cnl]);
		}

		if (empty($data))
		{
			return;
		}

		foreach ($data as $cnl => $newData)
		{
			if (! is_array($newData) || ! is_int($cnl))
			{
				continue;
			}
			$this->data[$cnl] = new DataCollection();
			$this->setFromArray($newData, $cnl);
		}
	}//end overlayArray()

	public function overlayString(string $str): void
	{
		/** @var array<int, array<mixed>>|null */
		$data = json_decode($str, true);
		if (! is_array($data))
		{
			return;
		}

		$this->overlayArray($data);
	}//end overlayString()
}//end class
