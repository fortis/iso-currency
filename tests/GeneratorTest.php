<?php

namespace IsoCurrency\Tests;

use IsoCurrency\Generation\Country;
use IsoCurrency\Generation\CurrencyIsoApiClient;
use IsoCurrency\Generation\FileWriter;
use IsoCurrency\Generation\Generator;
use PHPUnit\Framework\TestCase;
use Twig_Environment;

class GeneratorTest extends TestCase
{
    public function testGenerate()
    {
        $client = $this->getMockBuilder(CurrencyIsoApiClient::class)
                       ->disableOriginalConstructor()
                       ->setMethods(['fetch'])
                       ->getMock();

        $usa = new Country('UNITED STATES OF AMERICA (THE)', 'US Dollar', 'USD', 840, 2);
        $client->method('fetch')->willReturn([$usa]);
        $client->expects($this->once())
               ->method('fetch');

        $twig = $this->getMockBuilder(Twig_Environment::class)
                     ->setMethods(['render'])
                     ->getMock();

        $twig->expects($this->once())
             ->method('render');

        $fileWriter = $this->getMockBuilder(\SplFileObject::class)
                           ->setConstructorArgs(['/dev/null', 'w'])
                           ->setMethods(['fwrite'])
                           ->getMock();

        $fileWriter->expects($this->once())
                   ->method('fwrite');

        $generator = new Generator(
            $client,
            $twig,
            $fileWriter,
            'IsoCurrency.php.twig',
            '/dev/null'
        );

        $generator->generate();
    }
}
