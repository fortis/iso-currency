<?php

namespace IsoCurrency\Tests;

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

        $client->method('fetch')->willReturn([]);
        $client->expects($this->once())
               ->method('fetch');

        $twig = $this->getMockBuilder(Twig_Environment::class)
                     ->setMethods(['render'])
                     ->getMock();

        $twig->expects($this->once())
             ->method('render');

        $fileWriter = $this->getMockBuilder(FileWriter::class)
                           ->setMethods(['write'])
                           ->getMock();

        $fileWriter->expects($this->once())
                   ->method('write');

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
