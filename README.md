# iso-currency

[![Build Status](https://travis-ci.org/fortis/iso-currency.svg?branch=master)](https://travis-ci.org/fortis/iso-currency)

Very simple and easy-to-use `IsoCurrency` class to work with ISO 4217 currencies as they provided by the official ISO Maintenance Agency

## Usage

```php
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
