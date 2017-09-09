<?php

namespace IsoCurrency\Generation;

class CurrencyIsoClient
{
    const URL = 'http://www.currency-iso.org/dam/downloads/lists/list_one.xml';

    /**
     * @return array
     */
    public function fetch()
    {
        $countries = [];
        $content = file_get_contents(self::URL);
        $xml = new \SimpleXMLElement($content);
        foreach ($xml->{'CcyTbl'}->{'CcyNtry'} as $countryXml) {
            $code = (string)$countryXml->{'Ccy'};

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