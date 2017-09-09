# iso-currency

Very simple and easy-to-use `IsoCurrency` class to work with ISO 4217 currencies as they provided by the official ISO Maintenance Agency

## Usage

```php
// $usd = IsoCurrency::create('USD');
public function isUSD(IsoCurrency $currency) {
    return $currency->isEqualTo(IsoCurrency::USD());
}
```