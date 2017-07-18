<?php

/**
 * Exception class tests
 *
 * @package bingo-conveyor
 */

use PHPUnit\Framework\TestCase;
use Chemem\Bingo\Conveyor\Define;
use Chemem\Bingo\Conveyor\Conveyor;
use Chemem\Bingo\Conveyor\Collection;

class ExceptionTest extends TestCase
{
    /**
     * @expectedException InvalidArgumentException
     */

    public function testInvalidArgumentException()
    {
        $pug = Conveyor::compose('foo\bar');
    }

    /**
     * @expectedException InvalidArgumentException
     */

    public function testInvalidObjectException()
    {
        $loader = Conveyor::compose('Mustache_Loader_FilesystemLoader')
            ->apply(
                Define::compose(dirname(__DIR__) . '/sample/mustache'),
                Conveyor::compose('foo')
            );
    }
}
