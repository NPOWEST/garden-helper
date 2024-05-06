<?php

declare(strict_types = 1);

namespace Npowest\GardenHelper\Collection;

use ArrayAccess;
use ArrayIterator;
use Countable;
use IteratorAggregate;

/**
 * @implements ArrayAccess<string, int|float|string>
 * @implements IteratorAggregate<string, int|float|string>
 */
final class Collection implements ArrayAccess, Countable, IteratorAggregate
{
	/** @var array<string, float|int|string> */
	private array $data = [];

	/**
	 * @param array<mixed> $data
	 */
	public function setFromArray(array $data) : void
	{
		foreach ($data as $key => $value)
		{
			if (! \is_string($key))
			{
				continue;
			}

			if (\is_int($value) || \is_float($value) || \is_string($value))
			{
				$this->data[$key] = $value;
			}
		}
	}//end setFromArray()

	public function setFromString(string $str) : void
	{
		/** @var array<mixed>|false */
		$data = json_decode($str, true);
		if ($data === false)
		{
			return;
		}

		$this->setFromArray($data);
	}//end setFromString()

	/**
	 * Retrieves an ArrayIterator over the  values.
	 *
	 * @return ArrayIterator An iterator over all data
	 */
	public function getIterator() : ArrayIterator
	{
		return new ArrayIterator($this->data);
	}//end getIterator()

	/**
	 * Checks if the specified value exists.
	 *
	 * @param string $key the  option's name
	 *
	 * @return bool whether the  option exists
	 */
	public function offsetExists(mixed $key) : bool
	{
		return isset($this->data[$key]);
	}//end offsetExists()

	/**
	 * Retrieves a  value.
	 *
	 * @param string $key the  option's name
	 *
	 * @return float|int|string The  value
	 */
	public function offsetGet(mixed $key) : mixed
	{
		return $this->data[$key] ?? '';
	}//end offsetGet()

	/**
	 * Temporarily overwrites the value of a  variable.
	 *
	 * The  change will not persist. It will be lost
	 * after the request.
	 *
	 * @param string           $key   the  option's name
	 * @param float|int|string $value the temporary value
	 */
	public function offsetSet(mixed $key, mixed $value) : void
	{
		$this->set($key, $value);
	}//end offsetSet()

	/**
	 * Called when deleting a  value directly, triggers an error.
	 *
	 * @param string $key the  option's name
	 *
	 * @phpcsSuppress SlevomatCodingStandard.Functions.UnusedParameter
	 */
	public function offsetUnset(mixed $key) : void
	{
		trigger_error('Config values have to be deleted explicitly with the \phpbb\config\config::delete($key) method.', E_USER_ERROR);
	}//end offsetUnset()

	/**
	 * Retrieves the number of  options currently set.
	 *
	 * @return int Number of config options
	 */
	public function count() : int
	{
		return \count($this->data);
	}//end count()

	/**
	 * @return array<string, float|int|string>
	 */
	public function toArray() : array
	{
		return $this->data;
	}//end toArray()

	/**
	 * Removes a  option
	 *
	 * @param string $key The  option's name
	 */
	public function delete(string $key) : void
	{
		unset($this->data[$key]);
	}//end delete()

	public function set(string $key, mixed $value) : void
	{
		if (\is_int($value) || \is_float($value) || \is_string($value))
		{
			$this->data[$key] = $value;
		}
	}//end set()

	public function empty() : bool
	{
		return empty($this->data);
	}//end empty()

	public function merge(self $data) : void
	{
		$this->setFromArray($data->toArray());
	}//end merge()

	public function overlay(self $data) : void
	{
		$this->overlayArray($data->toArray());
	}//end overlay()

	/**
	 * @param array<mixed> $data [description]
	 */
	public function overlayArray(array $data) : void
	{
		$tmp = $this->data;
		$this->setFromArray($data);
		$this->setFromArray($tmp);
	}//end overlayArray()
}//end class
