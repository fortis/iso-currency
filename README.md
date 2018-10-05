# iso-currency

[![Travis](https://img.shields.io/travis/fortis/iso-currency.svg?branch=master)](https://travis-ci.org/fortis/iso-currency)
[![Coveralls](https://img.shields.io/coveralls/fortis/iso-currency/master.svg)](https://coveralls.io/github/fortis/iso-currency?branch=master)
[![Packagist](https://img.shields.io/packagist/l/fortis/iso-currency.svg)](https://packagist.org/packages/fortis/iso-currency)
[![FOSSA Status](https://app.fossa.io/api/projects/git%2Bgithub.com%2Ffortis%2Fiso-currency.svg?type=shield)](https://app.fossa.io/projects/git%2Bgithub.com%2Ffortis%2Fiso-currency?ref=badge_shield)

Very simple and easy-to-use `Currency` class to work with ISO 4217 currencies as they provided by the official ISO Maintenance Agency

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

Don't type currency codes as strings, instead it's better to use constants from auto generated CurrencyCode class as it's always up-to-date with currency-iso.org and helps you avoid typos.
For example, use `CurrencyCode::USD` instead of `'USD'`. Autocomplete will make it easier.

Also you can create new currency object with Currency class and autocomplete: `new Currency::USD()`.

``` php
// Create Currency instance.
$currency = new Currency(CurrencyCode::EUR);     // constructor  
$currency = Currency::create(CurrencyCode::EUR); // static factory method
$currency = Currency::EUR();                     // short syntax with autocomplete on ::

// Currency code validation.
$currency = new Currency('EUE'); // throws InvalidCurrencyException

// Check whether the given Currency is USD/EUR/etc.
$currency = new Currency(CurrencyCode::EUR);
$currency->is(Currency::EUR()); // true
$currency->is(Currency::USD()); // false
```

## License

iso-currency is licensed under the MIT license.


[![FOSSA Status](https://app.fossa.io/api/projects/git%2Bgithub.com%2Ffortis%2Fiso-currency.svg?type=large)](https://app.fossa.io/projects/git%2Bgithub.com%2Ffortis%2Fiso-currency?ref=badge_large)

## Source(s)

* "[ISO 4217](http://en.wikipedia.org/wiki/ISO_4217)" by [Wikipedia](http://www.wikipedia.org) licensed under [CC BY-SA 3.0 Unported License](http://en.wikipedia.org/wiki/Wikipedia:Text_of_Creative_Commons_Attribution-ShareAlike_3.0_Unported_License)