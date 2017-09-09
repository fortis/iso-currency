# iso-currency

Very simple and easy-to-use `IsoCurrency` class to work with ISO 4217 currencies as they provided by the official ISO Maintenance Agency

## Usage

```php
   /**
    * Returns whether the given IsoCurrency is USD.
    * @param \IsoCurrency\IsoCurrency $currency
    * @return bool
    */
    public function isUSD(IsoCurrency $currency) {
        return $currency->isEqualTo(IsoCurrency::USD());
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
