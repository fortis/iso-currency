<?php

namespace IsoCurrency\Generation;

use Twig_Environment;

class Generator
{
    /** @var Twig_Environment */
    private $twig;

    /** @var string */
    private $template;

    /**
     * @var \IsoCurrency\Generation\FileWriter
     */
    private $fileObject;
    /**
     * @var \IsoCurrency\Generation\CurrencyIsoApiClient
     */
    private $client;

    /**
     * Generator constructor.
     * @param \IsoCurrency\Generation\CurrencyIsoApiClient      $client
     * @param \Twig_Environment                                 $twig
     * @param \SplFileObject                                    $fileObject
     * @param                                                   $template
     */
    public function __construct(
        CurrencyIsoApiClient $client,
        Twig_Environment $twig,
        \SplFileObject $fileObject,
        $template
    ) {
        $this->twig = $twig;
        $this->template = $template;
        $this->fileObject = $fileObject;
        $this->client = $client;
    }

    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function generate()
    {
        /** @var Country[] $countries */
        $countries = $this->client->fetch();
        $currencies = [];
        foreach ($countries as $country) {
            $code = $country->getAlphabeticCode();
            $currencies[$code] = [
                'alphabeticCode' => $code,
                'minorUnit' => $country->getMinorUnit(),
                'numericCode' => $country->getNumericCode(),
            ];
        }

        $variables = ['currencyCodes' => array_keys($currencies), 'currencies' => $currencies];
        $data = $this->twig->render($this->template, $variables);

        return $this->fileObject->fwrite($data);
    }
}
