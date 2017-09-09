<?php

namespace IsoCurrency\Tests;

use IsoCurrency\Exception\InvalidCurrencyException;
use IsoCurrency\IsoCurrency;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for class IsoCurrencyTest.
 */
class IsoCurrencyTest extends TestCase
{
    public function testCreateInstance()
    {
        $this->assertInstanceOf(
            IsoCurrency::class,
            new IsoCurrency('USD')
        );

        $this->assertInstanceOf(
            IsoCurrency::class,
            IsoCurrency::create('USD')
        );

        $this->assertInstanceOf(
            IsoCurrency::class,
            IsoCurrency::USD()
        );
    }

    public function testUndefinedCurrency()
    {
        $this->expectException(InvalidCurrencyException::class);
        IsoCurrency::create('UASD');
    }

    public function testEmptyCurrency()
    {
        $this->expectException(InvalidCurrencyException::class);
        IsoCurrency::create('');
    }

    public function testCustomMinorUnit()
    {
        $usd = IsoCurrency::USD(0);
        $this->assertEquals(0, $usd->getMinorUnit());
    }

    public function testNegativeMinorUnit()
    {
        $this->expectException(InvalidCurrencyException::class);
        IsoCurrency::USD(-2);
    }

    public function testIs()
    {
        $currency = IsoCurrency::USD();
        $this->assertTrue($currency->is(IsoCurrency::create('USD')));
    }

    public function testToString()
    {
        $currency = IsoCurrency::USD();
        $this->assertEquals('USD', $currency);
    }

    public function testCode()
    {
        $currency = IsoCurrency::USD();
        $this->assertEquals('USD', $currency->getCode());
    }

    public function testMinorUnit()
    {
        $currency = IsoCurrency::USD();
        $this->assertEquals(2, $currency->getMinorUnit());
    }

    public function testJsonSerialization()
    {
        $currency = IsoCurrency::USD();
        $json = json_encode($currency);
        $data = json_decode($json);
        $this->assertTrue($currency->is(IsoCurrency::create($data->code)));
    }
}
