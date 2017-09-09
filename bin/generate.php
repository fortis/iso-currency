<?php

use GuzzleHttp\Client as GuzzleClient;
use Http\Adapter\Guzzle6\Client as GuzzleAdapter;
use Http\Message\MessageFactory\GuzzleMessageFactory;
use IsoCurrency\Generation\CurrencyIsoApiClient;
use IsoCurrency\Generation\FileWriter;
use IsoCurrency\Generation\Generator;

require_once __DIR__."/../vendor/autoload.php";

$guzzle = new GuzzleClient($config);
$adapter = new GuzzleAdapter($guzzle);
$currencyIsoClient = new CurrencyIsoApiClient($adapter, new GuzzleMessageFactory);
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
