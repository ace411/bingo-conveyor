<?php

/**
 * Bingo Conveyor Exceptions class
 * Useful for throwing exceptions
 *
 * @package bingo-conveyor
 * @license Apache 2.0
 * @author Lochemem Bruno Michael <lochbm@gmail.com>
 * @see InvalidArgumentException::class
 */

namespace Chemem\Bingo\Conveyor\Exceptions;

use Chemem\Bingo\Conveyor\Common\ExceptionInterface;

class InvalidArgumentException extends \InvalidArgumentException implements ExceptionInterface
{
    /**
     * InvalidArgument method
     *
     * @param mixed $arg The argument supplied
     * @param callable $method The method to which the argument is supplied
     * @throws InvalidArgumentException if argument supplied is not valid
     */

    public static function invalidArgument($arg, $method)
    {
        $type = gettype($arg); //get the type of the argument
        throw new static("The argument {$arg} of type {$type} passed to method {$method} is invalid");
    }

    /**
     * InvalidObject method
     *
     * @param object $object The object supplied
     * @param callable $method The method in which the object is supplied
     * @throws InvalidArgumentException if object supplied is not valid
     */

    public static function invalidObject($object, $method)
    {
        $methodArgs = (new \ReflectionMethod($method))->getParameters(); //get the method arguments
        $methodArgs = serialize($methodArgs);
        throw new static(
            "The object {$object} is invalid. {$methodArgs} are expected."
        );
    }
}
