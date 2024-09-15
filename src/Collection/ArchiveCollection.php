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
use Npowest\GardenHelper\Enum\SIEnum;

use function array_slice;
use function count;

/**
 * @implements ArrayAccess<SIEnum, array<string, DataCollection>>
 * @implements IteratorAggregate<SIEnum, array<string, DataCollection>>
 */
final class ArchiveCollection implements ArrayAccess, IteratorAggregate
{
	private bool $checkAvailability = true;

	/** @var array<string, array<string, DataCollection>> [type : [date : DataCollection]] */
	private array $data = [SIEnum::s->value => [], SIEnum::i->value => []];

	private ?DataCollection $total = null;

	/**
	 * Retrieves an ArrayIterator over the configuration values.
	 *
	 * @return ArrayIterator An iterator over all config data
	 * @phpstan-ignore missingType.generics
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
		if (! $key instanceof SIEnum)
		{
			throw new InvalidKey('SIEnum');
		}

		return isset($this->data[$key->value]);
	}//end offsetExists()

	/**
	 * Retrieves a  value.
	 *
	 * @param SIEnum $key
	 *
	 * @throws InvalidKey
	 */
	public function offsetGet(mixed $key): mixed
	{
		if (! $key instanceof SIEnum)
		{
			throw new InvalidKey('SIEnum');
		}

		return $this->data[$key->value];
	}//end offsetGet()

	/**
	 * Temporarily overwrites the value of a  variable.
	 *
	 * The  change will not persist. It will be lost after the request
	 *
	 * @param SIEnum                        $key
	 * @param array<string, DataCollection> $value
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
	 * @param SIEnum $key
	 *
	 * @throws DeleteException
	 */
	public function offsetUnset(mixed $key): void
	{
		throw new DeleteException();
	}//end offsetUnset()

	public function init(string $date): void
	{
		$this->data[SIEnum::s->value][$date] = new DataCollection();
		$this->data[SIEnum::i->value][$date] = new DataCollection();
	}//end init()

	public function initSi(string $date): void
	{
		$this->data[SIEnum::si->value] = [];

		$this->data[SIEnum::si->value][$date] = $this->data[SIEnum::s->value][$date];
	}//end initSi()

	public function addSi(string $date): void
	{
		$this->data[SIEnum::si->value][$date] = $this->data[SIEnum::s->value][$date];
	}//end addSi()

	public function getFirstKey(SIEnum $type): ?string
	{
		reset($this->data[$type->value]);

		return key($this->data[$type->value]);
	}//end getFirstKey()

	public function getLastKey(SIEnum $type): ?string
	{
		end($this->data[$type->value]);

		return key($this->data[$type->value]);
	}//end getLastKey()

	public function trim(string $date1, string $date1i, string $date2): void
	{
		$this->trimAct(SIEnum::s, $date1, $date2);
		$this->trimAct(SIEnum::i, $date1i, $date2);
	}//end trim()

	private function trimAct(SIEnum $key, string $date1, string $date2): void
	{
		$first = 0;
		$i     = 0;
		$count = count($this->data[$key->value]);
		$last  = $count;
		foreach ($this->data[$key->value] as $date => $val)
		{
			if (! $val->empty() && $date > $date1)
			{
				$first = $i;

				break;
			}
			++$i;
		}
		if ($i === $count)
		{
			$this->data[$key->value] = [];

			return;
		}

		end($this->data[$key->value]);
		for ($i = $count; $i > 0; --$i)
		{
			// @phpstan-ignore method.nonObject
			if (! current($this->data[$key->value])->empty() && key($this->data[$key->value]) < $date2)
			{
				$last = $i;

				break;
			}
			prev($this->data[$key->value]);
		}

		$this->data[$key->value] = array_slice($this->data[$key->value], $first, $last - $first);
	}//end trimAct()

	public function setCheckAvailability(bool $check): void
	{
		$this->checkAvailability = $check;
	}//end setCheckAvailability()

	private function checkData(SIEnum $type, string $date): bool
	{
		if (! isset($this->data[$type->value][$date]))
		{
			if ($this->checkAvailability)
			{
				return false;
			}
			$this->data[$type->value][$date] = new DataCollection();
		}

		return true;
	}//end checkData()

	public function set(SIEnum $type, string $date, string $key, mixed $value): void
	{
		if (! $this->checkData($type, $date))
		{
			return;
		}
		$this->data[$type->value][$date]->set($key, $value);
	}//end set()

	public function overlay(SIEnum $type, string $date, DataCollection $data): void
	{
		if (! $this->checkData($type, $date))
		{
			return;
		}
		$this->data[$type->value][$date]->overlay($data);
	}//end overlay()

	public function setFromString(SIEnum $type, string $date, string $value): void
	{
		if (! $this->checkData($type, $date))
		{
			return;
		}
		$this->data[$type->value][$date]->setFromString($value);
	}//end setFromString()

	public function setErrorFromString(SIEnum $type, string $date, string $value): void
	{
		if (! $this->checkData($type, $date))
		{
			return;
		}
		$this->data[$type->value][$date]->setErrorFromString($value);
	}//end setErrorFromString()

	/**
	 * @param array<string, mixed> $value
	 */
	public function setFromArray(SIEnum $type, string $date, array $value): void
	{
		if (! $this->checkData($type, $date))
		{
			return;
		}
		$this->data[$type->value][$date]->setFromArray($value);
	}//end setFromArray()

	public function sort(): void
	{
		ksort($this->data[SIEnum::i->value]);
		ksort($this->data[SIEnum::s->value]);
	}//end sort()

	public function hasTotal(): bool
	{
		return $this->total instanceof DataCollection && ! $this->total->empty();
	}//end hasTotal()

	/**
	 * @param array<string, mixed> $data
	 */
	public function setTotal(array $data): void
	{
		$this->total = new DataCollection();
		$this->total->setFromArray($data);
	}//end setTotal()

	public function getTotal(): ?DataCollection
	{
		return $this->total;
	}//end getTotal()
}//end class
