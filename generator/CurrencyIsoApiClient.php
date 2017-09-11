<?php

namespace CurrencyGenerator;

use Http\Client\HttpClient;
use Http\Message\RequestFactory;
use RuntimeException;

class CurrencyIsoApiClient
{
    const URL = 'http://www.currency-iso.org/dam/downloads/lists/list_one.xml';

    /** @var HttpClient */
    private $httpClient;

    /** @var RequestFactory */
    private $requestFactory;

    /**
     * CurrencyIsoApiClient constructor.
     * @param \Http\Client\HttpClient      $httpClient
     * @param \Http\Message\RequestFactory $requestFactory
     */
    public function __construct(HttpClient $httpClient, RequestFactory $requestFactory)
    {

        $this->httpClient = $httpClient;
        $this->requestFactory = $requestFactory;
    }

    /**
     * @return array
     * @throws RuntimeException
     * @throws \HttpResponseException
     * @throws \Http\Client\Exception
     * @throws \Exception
     */
    public function fetch()
    {
        $countries = [];

        $request = $this->requestFactory->createRequest('GET', self::URL);
        $response = $this->httpClient->sendRequest($request);
        if (!$body = $response->getBody()) {
            throw new RuntimeException('Empty response from currencies provider.');
        }

        $xml = new \SimpleXMLElement($body);

        foreach ($xml->{'CcyTbl'}->{'CcyNtry'} as $countryXml) {
            $code = (string)$countryXml->{'Ccy'};

            // Skip countries with empty currency code.
            if (empty($code)) {
                continue;
            }

            $countries[$code] = new Country(
                (string)$countryXml->{'CtryNm'},
                (string)$countryXml->{'CcyNm'},
                (string)$countryXml->{'Ccy'},
                (int)$countryXml->{'CcyNbr'},
                (int)$countryXml->{'CcyMnrUnts'}
            );
        }

        return $countries;
    }
}