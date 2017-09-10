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
