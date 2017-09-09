<?php

use IsoCurrency\Generation\CurrencyIsoClient;
use IsoCurrency\Generation\FileWriter;
use IsoCurrency\Generation\Generator;

require_once __DIR__."/../vendor/autoload.php";

$currencyIsoClient = new CurrencyIsoClient();
$loader = new Twig_Loader_Filesystem(__DIR__.'/../src/Resources/templates');
$twig = new Twig_Environment($loader);
$fileWriter = new FileWriter();

$generator = new Generator(
    $currencyIsoClient,
    $twig,
    $fileWriter,
    'IsoCurrency.php.twig',
    __DIR__.'/../src/IsoCurrency.php'
);

$generator->generate();
