<?php

namespace Scheb\Comparator\Tests;

use PHPUnit\Framework\MockObject\MockObject;
use Scheb\Comparator\Comparator;
use Scheb\Comparator\ValueComparisonStrategyInterface;
use Scheb\Comparator\Test\TestCase;

class ComparatorTest extends TestCase
{
    private function createComparator(bool $useTypeSensitiveOperator, array $customStrategies): Comparator
    {
        return new Comparator($useTypeSensitiveOperator, $customStrategies);
    }

    private function stubComparisonStrategyReturns(bool $result): MockObject
    {
        $comparisonStrategy = $this->createMock(ValueComparisonStrategyInterface::class);
        $comparisonStrategy
            ->expects($this->any())
            ->method('compare')
            ->willReturn($result);

        return $comparisonStrategy;
    }

    /**
     * @test
     */
    public function isEqual_notTypeSensitiveOperatorWithEqualValues_returnTrue(): void
    {
        $comparator = $this->createComparator(false, []);
        $result = $comparator->isEqual(1, '1');
        $this->assertTrue($result);
    }

    /**
     * @test
     */
    public function isEqual_notTypeSensitiveOperatorWithDifferentValues_returnFalse(): void
    {
        $comparator = $this->createComparator(false, []);
        $result = $comparator->isEqual(1, 2);
        $this->assertFalse($result);
    }

    /**
     * @test
     */
    public function isEqual_typeSensitiveOperatorWithIdenticalValues_returnTrue(): void
    {
        $comparator = $this->createComparator(true, []);
        $result = $comparator->isEqual(1, 1);
        $this->assertTrue($result);
    }

    /**
     * @test
     */
    public function isEqual_typeSensitiveOperatorWithDifferentValues_returnFalse(): void
    {
        $comparator = $this->createComparator(true, []);
        $result = $comparator->isEqual(1, '1');
        $this->assertFalse($result);
    }

    /**
     * @test
     */
    public function isEqual_customComparisonStrategy_isCalledWithValues(): void
    {
        $comparisonStrategy = $this->createMock(ValueComparisonStrategyInterface::class);
        $comparisonStrategy
            ->expects($this->once())
            ->method('compare')
            ->with(1, 2)
            ->willReturn(false);

        $comparator = $this->createComparator(true, [$comparisonStrategy]);
        $comparator->isEqual(1, 2);
    }

    /**
     * @test
     */
    public function isEqual_customComparisonStrategy_takePreferenceOverNativeComparison(): void
    {
        $comparisonStrategy1 = $this->stubComparisonStrategyReturns(false);
        $comparisonStrategy2 = $this->stubComparisonStrategyReturns(true);
        $comparator = $this->createComparator(true, [$comparisonStrategy1, $comparisonStrategy2]);

        $result = $comparator->isEqual(1, 2);
        $this->assertTrue($result);
    }

    /**
     * @test
     */
    public function isEqual_customComparisonFunctions_fallbackToNativeComparison(): void
    {
        $comparisonStrategy = $this->stubComparisonStrategyReturns(false);
        $comparator = $this->createComparator(true, [$comparisonStrategy]);

        $result = $comparator->isEqual(1, 1);
        $this->assertTrue($result);
    }
}
