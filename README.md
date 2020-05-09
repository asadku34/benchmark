# Benchmark you php script with this Micro Library.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/asad/benchmark.svg?style=flat-square)](https://packagist.org/packages/asad/benchmark)
[![Build Status](https://img.shields.io/travis/asadku34/benchmark/master.svg?style=flat-square)](https://travis-ci.org/asadku34/benchmark)
[![Quality Score](https://img.shields.io/scrutinizer/g/asadku34/benchmark.svg?style=flat-square)](https://scrutinizer-ci.com/g/asadku34/benchmark)
[![Total Downloads](https://img.shields.io/packagist/dt/asad/benchmark.svg?style=flat-square)](https://packagist.org/packages/asad/benchmark)
[![License](https://img.shields.io/github/license/mashape/apistatus.svg)](https://packagist.org/packages/asad/benchmark)

This package only for the Laravel App. If you want to use this package in non-laravel App then use this [Ubench](https://github.com/devster/ubench)

## Requirements

- [Laravel 5.\*](https://laravel.com/docs/5.0#server-requirements)

## Installation

You can install the package via composer:

```bash
composer require asad/benchmark
```

## Usage

```php

use Asad\Bench\Benchmark;

$bench = new Benchmark();

$bench->start();

// Execute some code

$bench->end();

// Get elapsed time and memory
echo $bench->getTime(); // 156ms or 1.123s
echo $bench->getTime(true); // elapsed microtime in float
echo $bench->getTime(false, '%d%s'); // 156ms or 1s

echo $bench->getMemoryPeak(); // 152B or 90.00Kb or 15.23Mb
echo $bench->getMemoryPeak(true); // memory peak in bytes
echo $bench->getMemoryPeak(false, '%.3f%s'); // 152B or 90.152Kb or 15.234Mb

// Returns the memory usage at the end mark
echo $bench->getMemoryUsage(); // 152B or 90.00Kb or 15.23Mb

// Accepts a callable as the first parameter.  Any additional parameters will be passed to the callable.
$result = $bench->run(function ($x) {
    return $x;
}, 1);
echo $bench->getTime();
```

### Facade

If you don't want to use [new](https://www.php.net/manual/en/language.types.object.php) keyword then use Facade.

```php
use Asad\Bench\BFacade;

BFacade::start();
// Execute some code
BFacade::end();

echo BFacade::getTime();
echo BFacade::getMemoryPeak(true);

```

### Testing

```bash
composer run test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

This Micro Framework developed by [Devster](https://github.com/devster/ubench). I'm the person who converted it to the Laravel package.

- [Devster](https://github.com/devster/ubench)
- [Asadur Rahman](https://github.com/asadku34)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
