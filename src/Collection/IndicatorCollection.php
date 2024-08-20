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
use IteratorAggregate;
use Npowest\GardenHelper\Collection\Exception\{DeleteException, InvalidKey, SetException};
use Npowest\GardenHelper\Enum\IndicatorEnum;

/**
 * @implements ArrayAccess<IndicatorEnum, array<int, int>>
 * @implements IteratorAggregate<IndicatorEnum, array<int, int>>
 */
final class IndicatorCollection implements ArrayAccess, IteratorAggregate
{
	/** @var array<string, array<int, int>> */
	private array $data = [
		IndicatorEnum::t->value => [0],
		IndicatorEnum::p->value => [0],
		IndicatorEnum::v->value => [0],
		IndicatorEnum::m->value => [0],
		IndicatorEnum::g->value => [0],
	];

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
	 * @param IndicatorEnum $key
	 *
	 * @throws InvalidKey
	 */
	public function offsetExists(mixed $key): bool
	{
		if (! $key instanceof IndicatorEnum)
		{
			throw new InvalidKey('IndicatorEnum');
		}

		return isset($this->data[$key->value]);
	}//end offsetExists()

	/**
	 * Retrieves a  value.
	 *
	 * @param IndicatorEnum $key
	 *
	 * @throws InvalidKey
	 */
	public function offsetGet(mixed $key): mixed
	{
		if (! $key instanceof IndicatorEnum)
		{
			throw new InvalidKey('IndicatorEnum');
		}

		return $this->data[$key->value];
	}//end offsetGet()

	/**
	 * Temporarily overwrites the value of a  variable.
	 *
	 * The  change will not persist. It will be lost after the request
	 *
	 * @param IndicatorEnum   $key
	 * @param array<int, int> $value
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
	 * @param IndicatorEnum $key
	 *
	 * @throws DeleteException
	 */
	public function offsetUnset(mixed $key): void
	{
		throw new DeleteException();
	}//end offsetUnset()

	/**
	 * @return array<string, array<int, int>>
	 */
	public function toArray(): array
	{
		return $this->data;
	}//end toArray()

	public function set(IndicatorEnum $type, int $cnl, int $value): void
	{
		$this->data[$type->value][$cnl] = $value;
	}//end set()

	public function get(IndicatorEnum $type, int $cnl): int
	{
		return $this->data[$type->value][$cnl] ?? 0;
	}//end get()

	/**
	 * @param array<string, array<int, int>> $array
	 */
	public function setFromArray(array $array): void
	{
		foreach ($array as $type => $list)
		{
			$type = IndicatorEnum::from($type);
			foreach ($list as $cnl => $value)
			{
				$this->set($type, $cnl, $value);
			}
		}
	}//end setFromArray()
}//end class
