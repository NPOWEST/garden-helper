<?php

declare(strict_types=1);

namespace Npowest\GardenHelper\Collection;

use ArrayAccess;
use ArrayIterator;
use Exception;
use IteratorAggregate;
use Npowest\GardenHelper\Collection\Exception\InvalidKey;
use Npowest\GardenHelper\Enum\SIEnum;

/**
 * @implements ArrayAccess<SIEnum, ListCollection>
 * @implements IteratorAggregate<SIEnum, ListCollection>
 */
final class ListArhiveCollection implements ArrayAccess, IteratorAggregate
{
	/** @var array<string, ListCollection> */
	private array $data;

	public function __construct()
	{
		$this->data = [
			SIEnum::s->value => new ListCollection(),
			SIEnum::i->value => new ListCollection(),
		];
	}//end __construct()

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
	 * @param SIEnum $key
	 *
	 * @throws InvalidKey
	 */
	public function offsetExists(mixed $key): bool
	{
		if (! ($key instanceof SIEnum))
		{
			throw new InvalidKey('SIEnum');
		}

		return isset($this->data[$key->value]);
	}//end offsetExists()

	/**
	 * Retrieves a  value.
	 *
	 * @throws InvalidKey
	 */
	public function offsetGet(mixed $key): mixed
	{
		if (! ($key instanceof SIEnum))
		{
			throw new InvalidKey('SIEnum');
		}

		return $this->data[$key->value] ?? null;
	}//end offsetGet()

	/**
	 * Temporarily overwrites the value of a  variable.
	 *
	 * The  change will not persist. It will be lost
	 * after the request.
	 *
	 * @throws Exception
	 */
	public function offsetSet(mixed $key, mixed $value): void
	{
		throw new Exception('Not Set');
	}//end offsetSet()

	/**
	 * Called when deleting a  value directly, triggers an error.
	 *
	 * @throws Exception
	 */
	public function offsetUnset(mixed $key): void
	{
		throw new Exception('Not UnSet');
	}//end offsetUnset()
}//end class
