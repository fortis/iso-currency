# iso-currency

[![Travis](https://img.shields.io/travis/fortis/iso-currency.svg?branch=master)](https://github.com/fortis/iso-currency)
[![Coveralls](https://img.shields.io/coveralls/fortis/iso-currency/master.svg)](https://coveralls.io/github/fortis/iso-currency?branch=master)

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
   /**
    * Returns whether the given IsoCurrency is USD.
    * @param IsoCurrency $currency
    * @return bool
    */
    public function isUSD(IsoCurrency $currency) {
        return $currency->is(IsoCurrency::USD());
    }

    /**
     * Creates IsoCurrency object.
     * @return IsoCurrency
     */
    public function createEURCurrency() {
        // return new IsoCurrency('EUR');
        // return IsoCurrency::create('EUR');
        return IsoCurrency::EUR();
    }
```

## License

iso-currency is licensed under the MIT license.

## Source(s)

* "[ISO 4217](http://en.wikipedia.org/wiki/ISO_4217)" by [Wikipedia](http://www.wikipedia.org) licensed under [CC BY-SA 3.0 Unported License](http://en.wikipedia.org/wiki/Wikipedia:Text_of_Creative_Commons_Attribution-ShareAlike_3.0_Unported_License)
