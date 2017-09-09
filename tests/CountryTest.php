<?php

namespace IsoCurrency\Tests;

use IsoCurrency\Generation\Country;
use PHPUnit\Framework\TestCase;

class CountryTest extends TestCase
{
    public function testCreateCountry()
    {
        $this->assertInstanceOf(
            Country::class,
            new Country('', 'USD', 'USD', 857, 2)
        );
    }
}
