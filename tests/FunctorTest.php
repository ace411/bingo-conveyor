<?php

/**
 * Collection functor and Define functor tests
 *
 * @package bingo-conveyor
 */

use PHPUnit\Framework\TestCase;
use Chemem\Bingo\Conveyor\Collection;
use Chemem\Bingo\Conveyor\Define;

class FunctorTest extends TestCase
{
    /**
     * Tests whether the Collection::compose method returns a ConveyorAbstract object
     */

    public function testComposeReturnsAbstractType()
    {
        $collection = Collection::compose([
            'title' => 'Dozerman',
            'values' => [
                'id' => 12,
                'text' => 'foo bar'
            ]
        ]);
        $this->assertInstanceOf(Chemem\Bingo\Conveyor\Common\ConveyorAbstract::class, $collection);
    }

    /**
     * Tests whether the Collection::compose->getIterator() method returns an iterator object
     */

    public function testCollectionReturnsArray()
    {
        $collection = Collection::compose([
            'title' => 'Dozerman',
            'values' => [
                'id' => 12,
                'text' => 'foo bar'
            ]
        ])->getIterator();
        $this->assertArrayHasKey('title', $collection);
    }

    /**
     * Tests whether the Define::compose()->__toString() magic method returns a string
     */

    public function testDefineReturnsString()
    {
        $string = Define::compose('foo');
        $valid = is_string((string) $string);
        $this->assertTrue($valid);
    }

    /**
     * Tests whether the Define::compose method returns a ConveyorAbstract object
     */

    public function testDefineReturnsAbstractType()
    {
        $string = Define::compose('foo');
        $this->assertInstanceOf(Chemem\Bingo\Conveyor\Common\ConveyorAbstract::class, $string);
    }

    /**
     * Tests whether the map method transforms a collection
     */

    public function testMapMethodCollectionTransformation()
    {
        $collection = Collection::compose([
                'foo' => 'bar'
            ])
            ->map(function ($values) {
                return array_map(function ($value) {
                    return "baz:{$value}";
                }, iterator_to_array($values));
            });
        $this->assertEquals(iterator_to_array($collection), ['foo' => 'baz:bar']);
    }

    /**
     * Tests whether the map method transforms a defined string
     */

    public function testMapMethodDefineTransformation()
    {
        $string = Define::compose('foo')
            ->map(function ($value) {
                return $value . ':bar';
            });
        $this->assertEquals((string) $string, 'foo:bar');
    }
}
