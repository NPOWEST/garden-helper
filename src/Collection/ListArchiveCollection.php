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
final class ListArchiveCollection implements ArrayAccess, IteratorAggregate
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
	 * @return ArrayIterator<string, ListCollection>
	 */
	public function getIterator(): ArrayIterator
	{
		return new ArrayIterator($this->data);
	}//end getIterator()

	/**
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
	 * @return ListCollection
	 *
	 * @throws InvalidKey
	 */
	public function offsetGet(mixed $key): mixed
	{
		if (! ($key instanceof SIEnum))
		{
			throw new InvalidKey('SIEnum');
		}

		return $this->data[$key->value];
	}//end offsetGet()

	/**
	 * @throws Exception
	 */
	public function offsetSet(mixed $key, mixed $value): void
	{
		throw new Exception('Not Set');
	}//end offsetSet()

	/**
	 * @throws Exception
	 */
	public function offsetUnset(mixed $key): void
	{
		throw new Exception('Not UnSet');
	}//end offsetUnset()

	public function set(SIEnum $type, ListCollection $list): void
	{
		$this->data[$type->value] = $list;
	}//end set()
}//end class
