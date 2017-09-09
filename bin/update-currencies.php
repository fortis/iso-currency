<?php

use IsoCurrency\Generation\Client;
use IsoCurrency\Generation\Generator;
use IsoCurrency\IsoCurrency;

require_once __DIR__."/../vendor/autoload.php";

$client = new Client();
/** @var \IsoCurrency\Generation\Country[] $countries */
$countries = $client->fetch();
$currencies = [];
foreach ($countries as $country) {
    $currencies[] = [
        'alphabeticCode' => $country->getAlphabeticCode(),
        'minorUnit' => $country->getMinorUnit(),
        'numericCode' => $country->getNumericCode(),
    ];
}

$generator = new Generator();
$generator->generate(
    'IsoCurrency.php.twig',
    [
        'currencyCodes' => array_keys($countries),
        'currencies' => $currencies,
    ]
);
