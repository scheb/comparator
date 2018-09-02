<?php

namespace Scheb\Comparator\Test;

use Scheb\Comparator\CallbackComparisonStrategy;

class CallbackComparisonStrategyTest extends TestCase
{
    /**
     * @test
     */
    public function compare_customComparisonFunction_isCalledWithValues(): void
    {
        $comparisonFunctionArguments = null;
        $comparisonFunction = function ($value1, $value2) use (&$comparisonFunctionArguments): bool {
            $comparisonFunctionArguments = func_get_args();

            return false;
        };

        $comparisonStrategy = new CallbackComparisonStrategy($comparisonFunction);
        $comparisonStrategy->compare(1, 2);

        $this->assertNotNull($comparisonFunctionArguments);
        $this->assertEquals([1, 2], $comparisonFunctionArguments);
    }

    /**
     * @test
     * @dataProvider provideCallbackReturnValues
     */
    public function compare_customComparisonFunction_returnResultOfComparisonFunction(bool $functionReturnValue): void
    {
        $comparisonFunction = function () use ($functionReturnValue): bool {
            return $functionReturnValue;
        };

        $comparisonStrategy = new CallbackComparisonStrategy($comparisonFunction);
        $result = $comparisonStrategy->compare(1, 2);
        $this->assertEquals($functionReturnValue, $result);
    }

    public function provideCallbackReturnValues(): array
    {
        return [
            [true],
            [false],
        ];
    }
}
