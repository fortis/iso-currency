<?php

use IsoCurrency\Generation\CurrencyIsoClient;
use IsoCurrency\Generation\Country;
use IsoCurrency\Generation\FileWriter;
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

$loader = new Twig_Loader_Filesystem(__DIR__.'/../src/Resources/templates');
$twig = new Twig_Environment($loader);
$fileWriter = new FileWriter();
$generator = new Generator($twig, $fileWriter, 'IsoCurrency.php.twig', __DIR__.'/../src/IsoCurrency.php');
$generator->generate(['currencyCodes' => array_keys($currencies), 'currencies' => $currencies,]);
