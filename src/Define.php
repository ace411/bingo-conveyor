<?php

/**
 * Bingo Conveyor Define class
 * Useful for manipulating string values meant to be used as parameters
 *
 * @package bingo-conveyor
 * @license Apache 2.0
 * @author Lochemem Bruno Michael <lochbm@gmail.com>
 */

namespace Chemem\Bingo\Conveyor;

use Chemem\Bingo\Conveyor\Common\ConveyorAbstract;
use Chemem\Bingo\Conveyor\Exceptions\InvalidArgumentException;

class Define extends ConveyorAbstract
{
    /**
     * Value stored in the Define functor
     *
     * @access private
     * @var mixed $value
     */

    private $value;

    /**
     * Define functor constructor
     *
     * @param mixed $value
     */

    public function __construct($value)
    {
        $this->value = is_string($value) ?
            $value :
            InvalidArgumentException::invalidArgument($value, __METHOD__);
    }

    /**
     * Define compose function
     *
     * @param string $value String value to be stored
     * @return object ConveyorAbstract A string encapsulated within an object
     */

    public static function compose($value) : ConveyorAbstract
    {
        return new static($value);
    }

    /**
     * Convert object to string
     *
     * @return string $value
     */

    public function __toString()
    {
        return $this->value;
    }
}
