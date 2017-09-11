<?php

namespace Currency\Tests\Currency;

use Currency\InvalidCurrencyException;
use Currency\Currency;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for class CurrencyTest.
 */
class CurrencyTest extends TestCase
{
    public function testCreateInstance()
    {
        $this->assertInstanceOf(
            Currency::class,
            new Currency('USD')
        );

        $this->assertInstanceOf(
            Currency::class,
            Currency::create('USD')
        );

        $this->assertInstanceOf(
            Currency::class,
            Currency::USD()
        );
    }

    public function testUndefinedCurrency()
    {
        $this->expectException(InvalidCurrencyException::class);
        Currency::create('UASD');
    }

    public function testEmptyCurrency()
    {
        $this->expectException(InvalidCurrencyException::class);
        Currency::create('');
    }

    public function testCustomMinorUnit()
    {
        $usd = Currency::USD(0);
        $this->assertEquals(0, $usd->getMinorUnit());
    }

    public function testNegativeMinorUnit()
    {
        $this->expectException(InvalidCurrencyException::class);
        Currency::USD(-2);
    }

    public function testIs()
    {
        $currency = Currency::USD();
        $this->assertTrue($currency->is(Currency::create('USD')));
    }

    public function testToString()
    {
        $currency = Currency::USD();
        $this->assertEquals('USD', $currency);
    }

    public function testCode()
    {
        $currency = Currency::USD();
        $this->assertEquals('USD', $currency->getCode());
    }

    public function testMinorUnit()
    {
        $currency = Currency::USD();
        $this->assertEquals(2, $currency->getMinorUnit());
    }

    public function testJsonSerialization()
    {
        $currency = Currency::USD();
        $json = json_encode($currency);
        $data = json_decode($json);
        $this->assertTrue($currency->is(Currency::create($data->code)));
    }
}
