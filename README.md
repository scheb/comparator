scheb/comparator
================

[![Build Status](https://travis-ci.org/scheb/comparator.svg?branch=master)](https://travis-ci.org/scheb/comparator)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/scheb/comparator/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/scheb/comparator/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/scheb/comparator/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/scheb/comparator/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/scheb/comparator/v/stable.svg)](https://packagist.org/packages/scheb/comparator)
[![License](https://poser.pugx.org/scheb/comparator/license.svg)](https://packagist.org/packages/scheb/comparator)

This library compares two values for equality.

If you need to add your own rules for comparing specific values, you can extend the library with your own comparison
strategies.

Features
--------

- Simple equality comparison (`==` or `===`)
- Strategy interface for your own comparison rules

Installation
------------

```bash
composer require scheb/comparator
```

How to use
----------

```php
$comparator = new \Scheb\Comparator\Comparator(true); // Type-sensive equal (===)
$comparator->isEqual(0, "0"); // Returns false
$comparator->isEqual(0, ""); // Returns false
$comparator->isEqual(0, 0); // Returns true
$comparator->isEqual(0, "foo"); // Returns false

$comparator = new \Scheb\Comparator\Comparator(false); // Type-insensive equal (==)
$comparator->isEqual(0, "0"); // Returns true
$comparator->isEqual(0, ""); // Returns true
$comparator->isEqual(0, 0); // Returns true
$comparator->isEqual(0, "foo"); // Returns false
```

How to extend
-------------

To add your own comparison strategy, implement `Scheb\Comparator\ValueComparisonStrategyInterface`.

Then, add an instance of that class via the constructor argument `$customComparisonStrategies` of
`Scheb\Comparator\Comparator`.

Custom comparison strategies take preference over default ones.

Contribute
----------
You're welcome to [contribute](https://github.com/scheb/comparator/graphs/contributors) to this library by
creating a pull requests or feature request in the issues section. For pull requests, please follow these guidelines:

- Symfony code style
- PHP7.1 type hints for everything (including: return types, `void`, nullable types)
- Please add/update test cases
- Test methods should be named `[method]_[scenario]_[expected result]`

To run the test suite install the dependencies with `composer install` and then execute `bin/phpunit`.

License
-------
This bundle is available under the [MIT license](LICENSE).
