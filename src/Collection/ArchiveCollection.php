<?php

declare(strict_types = 1);

namespace Npowest\GardenHelper\Collection;

use ArrayAccess;
use ArrayIterator;
use Countable;
use Exception;
use IteratorAggregate;
use Npowest\GardenHelper\Collection\Exception\InvalidKey;
use Npowest\GardenHelper\Enum\SIEnum;

final class ArchiveCollection implements ArrayAccess, Countable, IteratorAggregate
{
	private bool $checkAvailability = true;

	/** @var array<SIEnum, array<string, DataCollection>> [type : [date : DataCollection]] */
	private array $data = [SIEnum::s => [], SIEnum::i => []];

	private ?DataCollection $total = null;

	/**
	 * Retrieves an ArrayIterator over the configuration values
	 *
	 * @return ArrayIterator An iterator over all config data
	 */
	public function getIterator() : ArrayIterator
	{
		return new ArrayIterator($this->data);
	}//end getIterator()

	/**
	 * Checks if the specified config value exists
	 *
	 * @param SIEnum $key
	 *
	 * @throws InvalidKey
	 */
	public function offsetExists(mixed $key) : bool
	{
		if (! $key instanceof SIEnum)
		{
			throw new InvalidKey('SIEnum');
		}

		return isset($this->data[$key]);
	}//end offsetExists()

	/**
	 * Retrieves a  value
	 *
	 * @param SIEnum $key

	 * @throws InvalidKey
	 */
	public function offsetGet(mixed $key) : mixed
	{
		if (! $key instanceof SIEnum)
		{
			throw new InvalidKey('SIEnum');
		}

		return $this->data[$key];
	}//end offsetGet()

	/**
	 * Temporarily overwrites the value of a  variable
	 *
	 * The  change will not persist. It will be lost after the request
	 *
	 * @param SIEnum $key
	 * @param array<string, DataCollection> $value

	 * @throws Exception
	 */
	public function offsetSet(mixed $key, mixed $value) : void
	{
		throw new Exception('Values have to be add explicitly with the add($key, $value) method.');
	}//end offsetSet()

	/**
	 * Called when deleting a  value directly, triggers an error
	 *
	 * @param SIEnum $key

	 * @throws Exception
	 */
	public function offsetUnset(mixed $key) : void
	{
		throw new Exception('Values have to be deleted explicitly with the delete($key) method.');
	}//end offsetUnset()

	/**
	 * Retrieves the number of  options currently set
	 *
	 * @return int Number of config options
	 */
	public function count() : int
	{
		return \count($this->data);
	}//end count()

	public function init(string $date) : void
	{
		$this->data[SIEnum::s][$date] = new DataCollection();
		$this->data[SIEnum::i][$date] = new DataCollection();
	}//end init()

	public function initSi(string $date) : void
	{
		$this->data[SIEnum::si]        = [];
		$this->data[SIEnum::si][$date] = $this->data['s'][$date];
	}//end initSi()

	public function addSi(string $date) : void
	{
		$this->data[SIEnum::si][$date] = $this->data['s'][$date];
	}//end addSi()

	public function getFirstKey(SIEnum $type) : ?string
	{
		reset($this->data[$type]);

		return key($this->data[$type]);
	}//end getFirstKey()

	public function getLastKey(SIEnum $type) : ?string
	{
		end($this->data[$type]);

		return key($this->data[$type]);
	}//end getLastKey()

	public function trim(string $date1, string $date1i, string $date2) : void
	{
		$this->trimAct(SIEnum::s, $date1, $date2);
		$this->trimAct(SIEnum::i, $date1i, $date2);
	}//end trim()

	private function trimAct(SIEnum $key, string $date1, string $date2) : void
	{
		$first = 0;
		$i     = 0;
		$count = \count($this->data[$key]);
		$last  = $count;
		foreach ($this->data[$key] as $date => $val)
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
			$this->data[$key] = [];

			return;
		}

		end($this->data[$key]);
		for ($i = $count; $i > 0; --$i)
		{
			if (! current($this->data[$key])->empty() && key($this->data[$key]) < $date2)
			{
				$last = $i;

				break;
			}
			prev($this->data[$key]);
		}

		$this->data[$key] = \array_slice($this->data[$key], $first, $last - $first);
	}//end trimAct()

	public function setCheckAvailability(bool $check) : void
	{
		$this->checkAvailability = $check;
	}//end setCheckAvailability()

	private function checkData(SIEnum $type, string $date) : bool
	{
		if (! isset($this->data[$type][$date]))
		{
			if ($this->checkAvailability)
			{
				return false;
			}
			$this->data[$type][$date] = new DataCollection();
		}

		return true;
	}//end checkData()

	public function set(SIEnum $type, string $date, string $key, mixed $value) : void
	{
		if (! $this->checkData($type, $date))
		{
			return;
		}
		$this->data[$type][$date]->set($key, $value);
	}//end set()

	public function setFromString(SIEnum $type, string $date, string $value) : void
	{
		if (! $this->checkData($type, $date))
		{
			return;
		}
		$this->data[$type][$date]->setFromString($value);
	}//end setFromString()

	public function setErrorFromString(SIEnum $type, string $date, string $value) : void
	{
		if (! $this->checkData($type, $date))
		{
			return;
		}
		$this->data[$type][$date]->setErrorFromString($value);
	}//end setErrorFromString()

	/**
	 * @param array<string, mixed> $value
	 */
	public function setFromArray(SIEnum $type, string $date, array $value) : void
	{
		if (! $this->checkData($type, $date))
		{
			return;
		}
		$this->data[$type][$date]->setFromArray($value);
	}//end setFromArray()

	public function sort() : void
	{
		ksort($this->data['i']);
		ksort($this->data['s']);
	}//end sort()

	public function hasTotal() : bool
	{
		return $this->total instanceof DataCollection && ! $this->total->empty();
	}//end hasTotal()

	/**
	 * @param array<string, mixed> $data
	 */
	public function setTotal(array $data) : void
	{
		$this->total = new DataCollection();
		$this->total->setFromArray($data);
	}//end setTotal()

	public function getTotal() : ?DataCollection
	{
		return $this->total;
	}//end getTotal()
}//end class
