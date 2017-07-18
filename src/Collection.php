<?php

/**
 * Bingo Conveyor Collection class
 * Useful for manipulating collections used as Conveyor parameters
 *
 * @package bingo-conveyor
 * @license Apache 2.0
 * @author Lochemem Bruno Michael <lochbm@gmail.com>
 */

namespace Chemem\Bingo\Conveyor;

use Chemem\Bingo\Conveyor\Common\ConveyorAbstract;

class Collection extends ConveyorAbstract implements \IteratorAggregate
{
    /**
     * Values stored in the Collection functor
     *
     * @access private
     * @var mixed $values
     */

    private $values;

    /**
     * Collection functor constructor
     *
     * @param mixed $values
     */

    public function __construct($values)
    {
        $this->values = $values;
    }

    /**
     * Collection compose function
     *
     * @param mixed $values Values to be stored
     * @return object ConveyorAbstract An array encapsulated within an object
     */

    public static function compose($values) : ConveyorAbstract
    {
        if ($values instanceof Traversable) {
            $values = iterator_to_array($values);
        } elseif (!is_array($values)) {
            $values = [$values];
        }
        return new static($values);
    }

    /**
     * Get instance of array iterator class
     *
     * @see ArrayIterator::class
     * @link http://php.net/manual/en/class.arrayiterator.php
     * @return object ArrayIterator
     */

    public function getIterator()
    {
        return new \ArrayIterator($this->values);
    }
}
