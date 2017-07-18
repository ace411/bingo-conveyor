<?php

/**
 * Bingo Conveyor Exception Interface
 * Design contract for the bingo-conveyor Exception class
 *
 * @package bingo-conveyor
 * @license Apache 2.0
 * @author Lochemem Bruno Michael <lochbm@gmail.com>
 */

namespace Chemem\Bingo\Conveyor\Common;

interface ExceptionInterface
{
    /**
     * invalidArgument method
     * throws an exception if an argument supplied is incompatible with a method
     *
     * @param mixed $arg The invalid argument supplied
     * @param callable $method The method to which the argument is supplied
     */

    public static function invalidArgument($arg, $method);

    /**
     * invalidObject method
     * throws an exception if an object is invalid
     *
     * @param object $object The invalid object
     * @param callable $method The method in which the object is used
     */

    public static function invalidObject($object, $method);
}
