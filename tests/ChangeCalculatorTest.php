<?php

// Force typehinting into strict mode
declare(strict_types = 1);

namespace Tests;

/**
 * Unit tests for ChangeCalculator.
 * @author Duggie <wave@duggie>
 * @since 2017-10-19
 */

use App\ChangeCalculator;
use \PHPUnit\Framework\TestCase;
use TypeError;

class ChangeCalculatorTest extends TestCase
{
    /**
     * Test model instantiation with no data.
     * @expectedException TypeError
     */
    public function testChangeCalculatorInstantiation()
    {
        new ChangeCalculator();
    }

    /**
     * Test model instantiation with null.
     * @expectedException TypeError
     */
    public function testChangeCalculatorInstantiationWithNull()
    {
        new ChangeCalculator(null);
    }

    /**
     * Test model instantiation with bad data.
     * @expectedException TypeError
     */
    public function testChangeCalculatorInstantiationWithInvalidData()
    {
        new ChangeCalculator('button');
    }

    /**
     * Test model instantiation with object.
     * @expectedException TypeError
     */
    public function testChangeCalculatorInstantiationWithObject()
    {
        new ChangeCalculator(new \stdClass);
    }

    /**
     * Test model instantiation with false.
     * @expectedException TypeError
     */
    public function testChangeCalculatorInstantiationWithFalse()
    {
        new ChangeCalculator(false);
    }

    /**
     * Test model instantiation with a float.
     * @expectedException TypeError
     */
    public function testChangeCalculatorInstantiationWithFloat()
    {
        new ChangeCalculator(1.2345);
    }

    /**
     * Test model instantiation with negative int.
     * @expectedException \Exception
     */
    public function testChangeCalculatorInstantiationWithNegativeInt()
    {
        new ChangeCalculator(-1);
    }

    /**
     * Test calculate for zero change.
     */
    public function testCalculateWithZero()
    {
        $change_calculator = new ChangeCalculator(0);

        $this->assertInstanceOf('App\ChangeCalculator', $change_calculator);
        $this->assertSame($change_calculator->calculate(), []);
    }

    /**
     * Test calculate with a range of valid integer amounts.
     * @dataProvider changeAmountsToCoins
     */
    public function testCalculateWithValidIntegers($change_amount, $coins_array)
    {
        /** @var int $change_amount */
        $change_calculator = new ChangeCalculator($change_amount);

        $this->assertSame($change_calculator->calculate(), $coins_array);
    }

    /**
     * Test recursive with a range of valid integer amounts.
     * @dataProvider changeAmountsToCoins
     */
    public function testCalculateUsingRecursionWithValidIntegers($change_amount, $coins_array)
    {
        /** @var int $change_calculator */
        $change_calculator = new ChangeCalculator($change_amount);

        $this->assertSame($change_calculator->calculateUsingRecursion(), $coins_array);
    }

    /**
     * Test data for valid integer amounts.
     */
    public static function changeAmountsToCoins()
    {
        return [
            [1, [1]],
            [2, [2]],
            [3, [2, 1]],
            [4, [2, 2]],
            [5, [5]],
            [6, [5, 1]],
            [7, [5, 2]],
            [8, [5, 2, 1]],
            [9, [5, 2, 2]],
            [10, [10]],
            [80, [50, 20, 10]],
            [99, [50, 20, 20, 5, 2, 2]],
            [100, [100]],
            [101, [100, 1]],
            [199, [100, 50, 20, 20, 5, 2, 2]],
            [234, [200, 20, 10, 2, 2]],
        ];
    }
}
