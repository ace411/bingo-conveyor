<?php

require __DIR__ . '/vendor/autoload.php';

use Chemem\Bingo\Conveyor\Collection;
use Chemem\Bingo\Conveyor\Conveyor;
use Chemem\Bingo\Conveyor\Define;

$loader = Conveyor::compose('Mustache_Loader_FilesystemLoader')
    ->apply(
        Define::compose(__DIR__ . '/sample/mustache'),
        Collection::compose(['extension' => '.html'])
    );

$partials = Conveyor::compose('Mustache_Loader_FilesystemLoader')
    ->apply(
        Define::compose(__DIR__ . '/sample/mustache/partials'),
        Collection::compose(['extension' => '.mustache'])
    );

$mustache = Conveyor::compose('Mustache_Engine')
    ->addConfig(Collection::compose([
        'loader' => $loader,
        'partials_loader' => $partials,
        'cache' => (string) Define::compose(__DIR__ . '/cache/mustache'),
        'escape' => function ($value) {
            return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        }
    ]))
    ->convey(Define::compose('main'), Collection::compose(['title' => 'Dozerman']));
