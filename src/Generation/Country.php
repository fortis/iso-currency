<?php

namespace Currency\Generation;

/**
 * Class Country
 */
final class Country
{
    /**
     * @var string
     */
    private $alphabeticCode;
    /**
     * @var string
     */
    private $currencyName;
    /**
     * @var string
     */
    private $name;
    /**
     * @var int
     */
    private $minorUnit;
    /**
     * @var int
     */
    private $numericCode;

    /**
     * @param string $name
     * @param string $currencyName
     * @param string $alphabeticCode
     * @param int    $numericCode
     * @param int    $minorUnit
     */
    public function __construct($name, $currencyName, $alphabeticCode, $numericCode, $minorUnit)
    {
        $this->alphabeticCode = $alphabeticCode;
        $this->currencyName = $currencyName;
        $this->name = $name;
        $this->minorUnit = $minorUnit;
        $this->numericCode = $numericCode;
    }

    /**
     * @return string
     */
    public function getAlphabeticCode()
    {
        return $this->alphabeticCode;
    }

    /**
     * @return string
     */
    public function getCurrencyName()
    {
        return $this->currencyName;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getMinorUnit()
    {
        return $this->minorUnit;
    }

    /**
     * @return int
     */
    public function getNumericCode()
    {
        return $this->numericCode;
    }
}