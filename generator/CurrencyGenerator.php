<?php

namespace CurrencyGenerator;

use Twig_Environment;

class CurrencyGenerator
{
    /** @var Twig_Environment */
    private $twig;

    /** @var CurrencyIsoApiClient */
    private $client;

    /**
     * Generator constructor.
     * @param CurrencyIsoApiClient $client
     * @param \Twig_Environment                         $twig
     */
    public function __construct(CurrencyIsoApiClient $client, Twig_Environment $twig)
    {
        $this->twig = $twig;
        $this->client = $client;
    }

    /**
     * @param                $template
     * @param \SplFileObject $fileObject
     * @return int
     * @throws \RuntimeException
     * @throws \Http\Client\Exception
     * @throws \HttpResponseException
     * @throws \Exception
     * @throws \Twig_Error_Syntax
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Loader
     */
    public function generate($template, \SplFileObject $fileObject)
    {
        /** @var Country[] $countries */
        $countries = $this->client->fetch();
        $currencies = [];
        foreach ($countries as $country) {
            $code = $country->getAlphabeticCode();
            $key = $this->currencyCodeAsKey($code);
            $currencies[$key] = [
                'alphabeticCode' => $code,
                'minorUnit' => $country->getMinorUnit(),
                'numericCode' => $country->getNumericCode(),
            ];
        }

        $variables = ['currencyCodes' => array_keys($currencies), 'currencies' => $currencies];
        $data = $this->twig->render($template, $variables);

        return $fileObject->fwrite($data);
    }

    /**
     * Handles special cases for currency codes.
     * Example: TRY (Turkish Lira) is reserved word and can be used as const in PHP 7 only,
     *          so it should be named in a different way.
     * @param $code
     * @return mixed
     */
    private function currencyCodeAsKey($code)
    {
        $special = ['TRY' => 'TRYLIRA'];

        return isset($special[$code]) ? $special[$code] : $code;
    }
}
