<?php

/**
 * Bingo Conveyor Defaults class
 * Stores template engine basic configuration details
 *
 * @package bingo-conveyor
 * @license Apache 2.0
 * @author Lochemem Bruno Michael <lochbm@gmail.com>
 */

namespace Chemem\Bingo\Conveyor\Common;

class Defaults
{
    /**
     * Mustache Template Defaults
     *
     * @var array CONVEYOR_MUSTACHE_DEFAULTS
     */

    const CONVEYOR_MUSTACHE_DEFAULTS = [
        'template_class_prefix' => '__BingoTemplates_',
        'strict_callables' => true,
        'entity_flags' => ENT_QUOTES,
        'cache' => __DIR__ . '/cache/mustache',
        'pragmas' => [\Mustache_Engine::PRAGMA_FILTERS]
    ];

    /**
     * Pug Template Defaults
     *
     * @var array CONVEYOR_PUG_DEFAULTS
     */

    const CONVEYOR_PUG_DEFAULTS = [
        'prettyprint' => true,
        'extension' => '.pug',
        'expressionLanguage' => 'php',
        'cache' => __DIR__ . '/cache/pug'
    ];
}
