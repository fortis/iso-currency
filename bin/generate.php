<?php

use CurrencyGenerator\CurrencyIsoApiClient;
use GuzzleHttp\Client as GuzzleClient;
use Http\Adapter\Guzzle6\Client as GuzzleAdapter;
use Http\Message\MessageFactory\GuzzleMessageFactory;

require_once __DIR__.'/../vendor/autoload.php';

try {
    $guzzle = new GuzzleClient();
    $adapter = new GuzzleAdapter($guzzle);
    $currencyIsoClient = new CurrencyIsoApiClient($adapter, new GuzzleMessageFactory);
    $loader = new Twig_Loader_Filesystem(__DIR__.'/../generator/Resources/templates');
    $twig = new Twig_Environment($loader);

    $generator = new CurrencyGenerator\CurrencyGenerator($currencyIsoClient, $twig);

    $basePath = __DIR__.'/../src';
    $currencyFile = new \SplFileObject($basePath.'/Currency.php', 'w');
    $generator->generate('Currency.php.twig', $currencyFile);

    $currencyCodeFile = new \SplFileObject($basePath.'/CurrencyCode.php', 'w');
    $generator->generate('CurrencyCode.php.twig', $currencyCodeFile);
} catch (\Exception $exception) {
    error_log($exception->getMessage());
}
