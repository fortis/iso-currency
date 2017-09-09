<?php

use IsoCurrency\Generation\Client as CurrencyIsoClient;
use IsoCurrency\Generation\Country;
use IsoCurrency\Generation\Generator;

require_once __DIR__."/../vendor/autoload.php";

/** @var Country[] $countries */
$countries = (new CurrencyIsoClient())->fetch();
$currencies = [];
foreach ($countries as $country) {
    $code = $country->getAlphabeticCode();
    $currencies[$code] = [
        'alphabeticCode' => $code,
        'minorUnit' => $country->getMinorUnit(),
        'numericCode' => $country->getNumericCode(),
    ];
}

$generator = new Generator();
$generator->generate(
    'IsoCurrency.php.twig',
    [
        'currencyCodes' => array_keys($currencies),
        'currencies' => $currencies,
    ]
);
