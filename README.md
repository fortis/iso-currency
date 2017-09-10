# iso-currency

[![Travis](https://img.shields.io/travis/fortis/iso-currency.svg?branch=master)](https://github.com/fortis/iso-currency)
[![Coveralls](https://img.shields.io/coveralls/fortis/iso-currency/master.svg)](https://coveralls.io/github/fortis/iso-currency?branch=master)
[![Packagist](https://img.shields.io/packagist/l/fortis/iso-currency.svg)](https://packagist.org/packages/fortis/iso-currency)

Very simple and easy-to-use `IsoCurrency` class to work with ISO 4217 currencies as they provided by the official ISO Maintenance Agency

## What is ISO 4217

> ISO 4217 is a standard published by the International Organization for Standardization, which delineates currency designators, country codes (alpha and numeric), and references to minor units in three tables.
>
> *-- [Wikipedia](http://en.wikipedia.org/wiki/ISO_4217)*

## Install

Install directly from command line using Composer
``` bash
composer require fortis/iso-currency
```

## Use

``` php
// Create IsoCurrency instance.
$currency = new IsoCurrency('EUR');     // public constructor  
$currency = IsoCurrency::create('EUR'); // static factory method
$currency = IsoCurrency::EUR();         // magic method with autocomplete on IsoCurrency::

// Currency validation.
$currency = new IsoCurrency('EUE');    // throws InvalidCurrencyException

// Check whether the given IsoCurrency is USD/EUR/etc.
$currency = new IsoCurrency('USD');
$currency->is(IsoCurrency::EUR()); // false
$currency->is(IsoCurrency::USD()); // true
```

## License

iso-currency is licensed under the MIT license.

## Source(s)

* "[ISO 4217](http://en.wikipedia.org/wiki/ISO_4217)" by [Wikipedia](http://www.wikipedia.org) licensed under [CC BY-SA 3.0 Unported License](http://en.wikipedia.org/wiki/Wikipedia:Text_of_Creative_Commons_Attribution-ShareAlike_3.0_Unported_License)
