<?php

/**
 * Bingo Conveyor ConveyorInterface
 * The ConveyorAbstract design contract
 *
 * @package bingo-conveyor
 * @license Apache 2.0
 * @author Lochemem Bruno Michael <lochbm@gmail.com>
 */

namespace Chemem\Bingo\Conveyor\Common;

interface ConveyorInterface
{
    /**
     * The map function; allows one to bind a value stored in a functor to a function
     *
     * @param callable $fn The function onto which the stored value is mapped
     */

    public function map(callable $fn) : ConveyorInterface;
}
