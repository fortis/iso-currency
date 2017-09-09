<?php

namespace IsoCurrency\Tests;

use Http\Client\HttpClient;
use Http\Message\RequestFactory;
use IsoCurrency\Generation\CurrencyIsoApiClient;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;

class CurrencyIsoApiClientTest extends TestCase
{
    public function testFetch()
    {
        $request = $this->getMockBuilder(RequestInterface::class)->getMock();
        $requestFactory = $this->getMockBuilder(RequestFactory::class)
                               ->getMock();

        $requestFactory->expects($this->once())
                       ->method('createRequest')
                       ->willReturn($request);

        $httpClient = $this->getMockBuilder(HttpClient::class)
                           ->getMock();

        $httpClient->expects($this->once())
                   ->method('sendRequest')
                   ->willReturn($request);

        $this->expectException(\RuntimeException::class);
        $client = new CurrencyIsoApiClient($httpClient, $requestFactory);
        $client->fetch();
    }
}
