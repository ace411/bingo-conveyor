<?php

/**
 * Bingo Conveyor ConveyorAbstract class
 * An abstract class used throughout the package
 *
 * @package bingo-conveyor
 * @license Apache 2.0
 * @author Lochemem Bruno Michael <lochbm@gmail.com>
 */

namespace Chemem\Bingo\Conveyor\Common;

abstract class ConveyorAbstract implements ConveyorInterface
{
    /**
     * Compose method for storing values in functor
     *
     * @abstract
     * @param mixed $value The value to be stored by functor
     * @return object ConveyorAbstract
     */

    abstract public static function compose($value) : ConveyorAbstract;

    /**
     * Map method for manipulating stored values
     *
     * @param callable $fn The function onto which the stored value is mapped
     * @return object ConveyorInterface
     */

    public function map(callable $fn) : ConveyorInterface
    {
        return $this->compose($fn($this));
    }
}
