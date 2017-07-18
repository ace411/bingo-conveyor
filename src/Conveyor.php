<?php

/**
 * Bingo Conveyor Conveyor class
 * Eponymous with the package; useful for abstracting pug and Mustache engine actions
 *
 * @package bingo-conveyor
 * @license Apache 2.0
 * @author Lochemem Bruno Michael <lochbm@gmail.com>
 */

namespace Chemem\Bingo\Conveyor;

use Chemem\Bingo\Conveyor\Common\Defaults;
use Chemem\Bingo\Conveyor\Common\ConveyorAbstract;
use Chemem\Bingo\Conveyor\Exceptions\InvalidArgumentException;

class Conveyor extends ConveyorAbstract
{
    /**
     * The view engine
     *
     * @access private
     * @var mixed $engine
     */

    private $engine;

    /**
     * Conveyor constructor
     *
     * @param mixed $engine
     */

    public function __construct($engine)
    {
        $this->engine = is_string($engine) || is_object($engine) ?
            $engine :
            InvalidArgumentException::invalidArgument($engine, __METHOD__);
    }

    /**
     * Conveyor compose function
     *
     * @param mixed $value The value to be stored
     * @return object ConveyorAbstract
     */

    public static function compose($value) : ConveyorAbstract
    {
        return class_exists($value) ?
            new static($value) :
            InvalidArgumentException::invalidArgument($value, __METHOD__);
    }

    /**
     * Build configuration from scratch
     *
     * @param ConveyorAbstract $values The iterator with configuration options
     * @return ConveyorAbstract
     */

    public function buildConfig(ConveyorAbstract $values) : ConveyorAbstract
    {
        $values = $values instanceof \Traversable ?
            iterator_to_array($values) :
            InvalidArgumentException::invalidArgument($values, __METHOD__);
        $obj = new $this->engine($values);
        return new static($obj);
    }

    /**
     * Apply a string and an iterator to an object
     *
     * @param ConveyorAbstract $value
     * @param ConveyorAbstract $arbitrary
     * @return ConveyorAbstract
     */

    public function apply(ConveyorAbstract $value, ConveyorAbstract $arbitrary = null)
    {
        $value = !is_null($value) ? $value : InvalidArgumentException::invalidArgument($value, __METHOD__);
        $arbitrary = !is_null($arbitrary) ?
            $arbitrary instanceof \Traversable ? iterator_to_array($arbitrary) : $arbitrary :
            InvalidArgumentException::invalidObject($arbitrary, __METHOD__);
        return new $this->engine($value, $arbitrary);
    }

    /**
     * Display markup
     *
     * @param ConveyorAbstract $template The HTML template to be rendered
     * @param ConveyorAbstract $values Template options
     * @return object $engine
     */

    public function convey(ConveyorAbstract $template, ConveyorAbstract $values)
    {
        $values = $values instanceof \Traversable ?
            iterator_to_array($values) :
            InvalidArgumentException::invalidArgument($values, __METHOD__);
        return $this->engine->render((string) $template, $values);
    }

    /**
     * Add configuration to the defaults
     *
     * @param ConveyorAbstract $property
     * @return ConveyorAbstract
     */

    public function addConfig(ConveyorAbstract $property) : ConveyorAbstract
    {
        $property = iterator_to_array($property); //instance check
        $validOption = array_filter(array_keys($property), function ($value) {
            return gettype($value) === 'string';
        });
        $properties = array_merge(
            $this->get() === 'Mustache_Engine' ?
                Defaults::CONVEYOR_MUSTACHE_DEFAULTS :
                Defaults::CONVEYOR_PUG_DEFAULTS,
            $validOption ? $property : []);
        return $this->buildConfig(Collection::compose($properties));
    }

    public function add(ConveyorAbstract $values)
    {
        return new static($values->get()($this->get()));
    }

    /**
     * Get the engine
     *
     * @return mixed $engine
     */

    public function get()
    {
        return $this->engine;
    }
}
