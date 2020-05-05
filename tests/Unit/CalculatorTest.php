<?php

use PHPUnit\Framework\TestCase;
use App\Calculator;
class CalculatorTest extends TestCase
{
    public function test_sum()
    {
        $calculator = new Calculator();
        $this->assertEquals(5, $calculator->sum(3, 2));

        //Verify the type of class
        $this->assertInstanceOf(Calculator::class, $calculator);
    }

    public function test_asserts()
    {
        $this->assertTrue(true);
        //Verify if the class contains an attribute
        $this->assertClassHasAttribute('operator', Calculator::class);

        //Verify if an element exists in an array
        $this->assertContains(5, [4,5,3,2,8]);

    }
}