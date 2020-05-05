<?php

use PHPUnit\Framework\TestCase;
use App\Calculator;
class CalculatorTest extends TestCase
{
    public function test_sum()
    {
        $calculator = new Calculator();
        $this->assertEquals(5, $calculator->sum(3, 2));
    }

    public function test_asserts()
    {
        $this->assertClassHasAttribute('operator', Calculator::class);

    }
}