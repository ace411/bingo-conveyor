# Bingo Conveyor

The Bingo Conveyor is a micro service, a view rendering library which abstracts Mustache and Pug core functions. The subsequent text is documentation of the library and should help you, the reader, understand how to go about using it.

## Installation

Before you can use the bingo-conveyor software, you should have either Git or Composer installed on your system of preference. To install the package via Composer, type the following in your preferred command line interface:

```composer require chemem/bingo-conveyor```

To install via Git, type:

```git clone https://github.com/ace411/bingo-conveyor.git```


## Usage

The library enables those who choose to use it, the ability to generate markup expressed as either Mustache templates or Pug boilerplates.

### Setting up

In order to use the library, one must be familiar with its pervasive elements, the Collection, Definition, and Conveyor classes.

#### The Collection class

This class implements the PHP IteratorAggregate interface and converts all the array values passed to it to ConveyorAbstract type objects. The Collection class, simply put, works with arrays. Below is a practical use case:

```php
$collections = Chemem\Bingo\Conveyor\Collections::compose([
    'title' => 'Sample page',
    'dbData' => [
        'name' => 'foo',
        'age' => 132
    ]
]); //returns a Collection iterator object
```
The data used in the snippet above is data that can be used in a template file. Constructor options as well as helper function collections can also be stored in the Collection functor.

#### The Define class

The Define class is used primarily with strings. Functor parameters, as well as other arbitrary string values, can be used with this structure. A simple definition can be fashioned to look like this:

```php
$directory = Chemem\Bingo\Conveyor\Define::compose(__DIR__ . '/sample/mustache')
    ->map(function ($value) {
        return str_replace(DIRECTORY_SEPARATOR, '/', $value);
    }); //returns a Define object
```
The non-mandatory map method is, in the case above, used to turn backward slashes in the URL provided into forward slashes.

#### The Conveyor class

Eponymous with the package, the conveyor class is used to interact with Pug and Mustache template engine environments. Configurations can be built or incrementally added to the class to the user's desire.

**Mustache Templates**

Building a Mustache template can be done in one of two ways: using the ```buildConfig()``` method or ```addConfig()``` method with the ```convey()``` method.

**Building a Mustache configuration**

The build option requires one to create a configuration from scratch. This option mimics passing constructor options to the ```Mustache_Engine``` constructor. The snippet below demonstrates how to use the build method with a mustache environment:

```php

require __DIR__ . '/vendor/autoload.php';

use Chemem\Bingo\Conveyor\Define;
use Chemem\Bingo\Conveyor\Conveyor;
use Chemem\Bingo\Conveyor\Collection;

$mustache = Conveyor::compose('Mustache_Engine')
    ->buildConfig(Collection::compose([
        'loader' => Conveyor::compose('Mustache_Loader_FilesystemLoader')
            ->apply(
                Define::compose(__DIR__ . '/sample/mustache'),
                Collection::compose(['extension' => '.html'])
            )
    ])); //returns a ConveyorAbstract object
```

**Adding options to default Mustache configuration**

The add option enables users to incrementally add configuration options to mustache-php. Take a look at the default options defined in the ```Defaults``` class to find out exactly what to add. The sample shown below is a great illustration of how to add mustache-php helpers to bingo-conveyor:

```php
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
    ])); //returns a ConveyorAbstract object
```

**Pug templates**

Pug, an alternative to Mustache, is an HAML implementation compatible with the bingo-conveyor library. Configuring Pug is done in a manner similar to setting up mustache-php. The only discernible difference is the use of the namespace Pug.

```php
$pug = Conveyor::compose('Pug\Pug')
    ->addConfig(Collection::compose([
        'cache' => Define::compose(__DIR__ . '/cache/pug')
    ]))
    ->get(); //returns a Pug object
```

Build and add options can also be used on Pug templates.

**Rendering HTML**

The primary function of the bingo-conveyor library is to render HTML. The convey method in the Conveyor class is central to this purpose. After configuring a template engine of preference, pass a template string object and an option iterator object to the Conveyor class to generate HTML.

```php
//Mustache templates
$mustache = Conveyor::compose('Mustache_Engine')
    ->addConfig(Collection::compose([
        'loader' => Conveyor::compose('Mustache_Loader_FilesystemLoader')
            ->apply(
                Define::compose(__DIR__ . '/sample/mustache'),
                Collection::compose(['extension' => '.html'])
            ),
        'helpers' => Collection::compose([
            'upper' => function ($value) {
                return strtoupper($value);
            },
            'lower' => function ($value) {
                return strtolower($value);
            }
        ])    
    ]))
    ->convey(
        Define::compose('main'),
        Collection::compose(['title' => 'Dozerman'])
    ); //returns HTML string

//Pug Templates
$pug = Conveyor::compose('Pug\Pug')
    ->addConfig(Collection::compose([
        'cache' => Define::compose(__DIR__ . '/cache/pug')
    ]))
    ->convey(
        Define::compose(__DIR__ . '/sample/pug/main.pug'),
        Collection::compose(['pageTitle' => 'Dozerman'])
    ); //returns an HTML string
```
