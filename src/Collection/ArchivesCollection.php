<?php

declare(strict_types=1);

namespace Npowest\GardenHelper\Collection;

use ArrayAccess;
use ArrayIterator;
use Countable;
use Exception;
use IteratorAggregate;
use Npowest\GardenHelper\Collection\Exception\DeleteException;
use Npowest\GardenHelper\Collection\Exception\InvalidKey;
use Npowest\GardenHelper\Collection\Exception\SetException;
use function count;
use function is_int;

final class ArchivesCollection implements ArrayAccess, Countable, IteratorAggregate
{
	/** @var array<int, ArchiveCollection> [cnl : ArchiveCollection] */
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
	 * @param int $key
	 *
	 * @return ArchiveCollection
	 *
	 * @throws InvalidKey
	 */
	public function offsetGet(mixed $key): mixed
	{
		if (! is_int($key))
		{
			throw new InvalidKey('int');
		}

		if (! isset($this->data[$key]))
		{
			$this->data[$key] = new ArchiveCollection();
		}

		return $this->data[$key];
	}//end offsetGet()

	/**
	 * Temporarily overwrites the value of a  variable.
	 *
	 * The  change will not persist. It will be lost
	 * after the request.
	 *
	 * @param int               $key
	 * @param ArchiveCollection $value
	 *
	 * @throws SetException
	 *
	 * @phpcsSuppress SlevomatCodingStandard.Functions.UnusedParameter
	 */
	public function offsetSet(mixed $key, mixed $value): void
	{
		throw new SetException();
	}//end offsetSet()

	/**
	 * Called when deleting a  value directly, triggers an error.
	 *
	 * @param int $key
	 *
	 * @throws DeleteException
	 *
	 * @phpcsSuppress SlevomatCodingStandard.Functions.UnusedParameter
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

	public function clear(): void
	{
		$this->data = [];
	}//end clear()
}//end class
