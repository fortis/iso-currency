<?php

namespace IsoCurrency\Tests;

use Http\Client\HttpClient;
use Http\Message\RequestFactory;
use IsoCurrency\Generation\CurrencyIsoApiClient;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class CurrencyIsoApiClientTest extends TestCase
{
    public function testFetch()
    {
        $requestFactory = $this->getMockBuilder(RequestFactory::class)
                               ->getMock();

        $request = $this->getMockBuilder(RequestInterface::class)->getMock();
        $requestFactory->expects($this->once())
                       ->method('createRequest')
                       ->willReturn($request);

        $httpClient = $this->getMockBuilder(HttpClient::class)
                           ->getMock();

        $xml = '<ISO_4217 Pblshd="2017-06-09"><CcyTbl>
                    <CcyNtry>
                        <CtryNm>UNITED STATES OF AMERICA (THE)</CtryNm>
                        <CcyNm>US Dollar</CcyNm>
                        <Ccy>USD</Ccy>
                        <CcyNbr>840</CcyNbr>
                        <CcyMnrUnts>2</CcyMnrUnts>
                    </CcyNtry>
                </CcyTbl></ISO_4217>';

        $response = $this->getMockBuilder(ResponseInterface::class)->getMock();
        $response->expects($this->once())
                 ->method('getBody')
                 ->willReturn($xml);


        $httpClient->expects($this->once())
                   ->method('sendRequest')
                   ->willReturn($response);

        $client = new CurrencyIsoApiClient($httpClient, $requestFactory);
        $this->assertArrayHasKey('USD', $client->fetch());
    }
}
