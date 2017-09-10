<?php

use GuzzleHttp\Client as GuzzleClient;
use Http\Adapter\Guzzle6\Client as GuzzleAdapter;
use Http\Message\MessageFactory\GuzzleMessageFactory;
use Currency\Generation\CurrencyIsoApiClient;
use Currency\Generation\FileWriter;
use Currency\Generation\Generator;

require_once __DIR__."/../vendor/autoload.php";

try {
    $guzzle = new GuzzleClient();
    $adapter = new GuzzleAdapter($guzzle);
    $currencyIsoClient = new CurrencyIsoApiClient($adapter, new GuzzleMessageFactory);
    $loader = new Twig_Loader_Filesystem(__DIR__.'/../src/Resources/templates');
    $twig = new Twig_Environment($loader);

    $generator = new Generator($currencyIsoClient, $twig);

    $basePath = __DIR__.'/../src';
    $currencyFile = new \SplFileObject($basePath.'/Currency.php', 'w');
    $generator->generate('Currency.php.twig', $currencyFile);

    $currencyCodeFile = new \SplFileObject($basePath.'/CurrencyCode.php', 'w');
    $generator->generate('CurrencyCode.php.twig', $currencyCodeFile);
} catch (\Exception $exception) {
    error_log($exception->getMessage());
}
