<?php

/**
 * Conveyor Functor test
 *
 * @package bingo-conveyor
 */

use PHPUnit\Framework\TestCase;
use Chemem\Bingo\Conveyor\Define;
use Chemem\Bingo\Conveyor\Conveyor;
use Chemem\Bingo\Conveyor\Collection;

class ConveyorTest extends TestCase
{
    /**
     * Tests whether Conveyor::compose() method calls constructor for the Mustache_Engine
     */

    public function testMustacheInstanceCreation()
    {
        $mustache = new Conveyor('Mustache_Engine');
        $this->assertSame($mustache->get(), Conveyor::compose('Mustache_Engine')->get());
    }

    /**
     * Tests whether Conveyor::compose() method calls constructor for the Pug engine
     */

    public function testPugInstanceCreation()
    {
        $pug = new Conveyor('Pug\Pug');
        $this->assertSame($pug->get(), Conveyor::compose('Pug\Pug')->get());
    }

    /**
     * Tests whether building configuration for the Mustache engine returns a ConveyorAbstract object
     */

    public function testMustacheBuildConfig()
    {
        $mustache = Conveyor::compose('Mustache_Engine')
            ->buildConfig(Collection::compose([
                'loader' => Conveyor::compose('Mustache_Loader_FilesystemLoader')
                    ->apply(
                        Define::compose(dirname(__DIR__) . '/sample/mustache'),
                        Collection::compose(['extension' => '.html'])
                    )
            ]));
        $this->assertInstanceOf(Chemem\Bingo\Conveyor\Common\ConveyorAbstract::class, $mustache);
    }

    /**
     * Tests whether adding Mustache engine configuration to the Conveyor class returns a ConveyorAbstract object
     */

    public function testMustacheAddConfig()
    {
        $mustache = Conveyor::compose('Mustache_Engine')
            ->addConfig(Collection::compose([
                'helpers' => Collection::compose([
                    'upper' => function ($value) {
                        return strtoupper($value);
                    },
                    'lower' => function ($value) {
                        return strtolower($value);
                    }
                ])
            ]));
        $this->assertInstanceOf(Chemem\Bingo\Conveyor\Common\ConveyorAbstract::class, $mustache);
    }

    /**
     * Tests whether building configuration for the Pug engine returns a ConveyorAbstract object
     */

    public function testPugBuildConfig()
    {
        $pug = Conveyor::compose('Pug\Pug')
            ->buildConfig(Collection::compose([
                'prettyprint' => true,
                'extension' => '.pug',
                'basedir' => dirname(__DIR__) . '/sample/pug'
            ]));
        $this->assertInstanceOf(Chemem\Bingo\Conveyor\Common\ConveyorAbstract::class, $pug);
    }

    /**
     * Tests whether adding Pug engine configuration to the Conveyor class returns a ConveyorAbstract object
     */

    public function testPugAddConfig()
    {
        $pug = Conveyor::compose('Pug\Pug')
            ->addConfig(Collection::compose([
                'basedir' => dirname(__DIR__) . '/sample/pug'
            ]));
        $this->assertInstanceOf(Chemem\Bingo\Conveyor\Common\ConveyorAbstract::class, $pug);
    }

    /**
     * Tests whether a Pug object is returned when the get() method is used with the buildConfig() method
     */

    public function testPugInstanceReturnedOnBuild()
    {
        $pug = Conveyor::compose('Pug\Pug')
            ->buildConfig(Collection::compose([
                'prettyprint' => true,
                'extension' => '.pug',
                'basedir' => dirname(__DIR__) . '/sample/pug'
            ]))
            ->get();
        $this->assertInstanceOf(Pug\Pug::class, $pug);
    }

    /**
     * Tests whether a Mustache object is returned when the get() method is used with the buildConfig() method
     */

    public function testMustacheInstanceReturnedOnBuild()
    {
        $mustache = Conveyor::compose('Mustache_Engine')
            ->buildConfig(Collection::compose([
                'loader' => Conveyor::compose('Mustache_Loader_FilesystemLoader')
                    ->apply(
                        Define::compose(dirname(__DIR__) . '/sample/mustache'),
                        Collection::compose(['extension' => '.html'])
                    )
            ]))
            ->get();
        $this->assertInstanceOf(Mustache_Engine::class, $mustache);
    }

    /**
     * Tests whether a Mustache object is returned when the get() method is used with the addConfig() method
     */

    public function testMustacheInstanceReturnedOnAdd()
    {
        $mustache = Conveyor::compose('Mustache_Engine')
            ->addConfig(Collection::compose([
                'helpers' => Collection::compose([
                    'upper' => function ($value) {
                        return strtoupper($value);
                    },
                    'lower' => function ($value) {
                        return strtolower($value);
                    }
                ])
            ]))
            ->get();
        $this->assertInstanceOf(Mustache_Engine::class, $mustache);
    }

    /**
     * Tests whether a Pug object is returned when the get() method is used with the addConfig() method
     */

    public function testPugInstanceReturnedOnAdd()
    {
        $pug = Conveyor::compose('Pug\Pug')
            ->addConfig(Collection::compose([
                'basedir' => dirname(__DIR__) . '/sample/pug'
            ]))
            ->get();
        $this->assertInstanceOf(Pug\Pug::class, $pug);
    }

    /**
     * Tests whether a combination of the convey method and Mustache object returns an HTML document
     */

    public function testMustacheHtmlDocReturned()
    {
        $mustache = Conveyor::compose('Mustache_Engine')
            ->addConfig(Collection::compose([
                'loader' => Conveyor::compose('Mustache_Loader_FilesystemLoader')
                    ->apply(
                        Define::compose(dirname(__DIR__) . '/sample/mustache'),
                        Collection::compose(['extension' => '.html'])
                    )
            ]))
            ->convey(
                Define::compose('main'),
                Collection::compose(['title' => 'Dozerman'])
            );
        $validHtml = (new DOMDocument())->loadHTML($mustache);
        $this->assertTrue($validHtml);
    }

    /**
     * Tests whether a combination of the convey method and Pug object returns an HTML document
     */

    public function testPugHtmlDocReturned()
    {
        $pug = Conveyor::compose('Pug\Pug')
            ->addConfig(Collection::compose([
                'basedir' => dirname(__DIR__) . '/sample/pug'
            ]))
            ->convey(
                Define::compose(dirname(__DIR__) . '/sample/pug/main.pug'),
                Collection::compose(['pageTitle' => 'Dozerman'])
            );
        $validHtml = (new DOMDocument())->loadHTML($pug);
        $this->assertTrue($validHtml);
    }
}
