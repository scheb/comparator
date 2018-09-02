<?php

namespace Scheb\Comparator\Test;

use Scheb\Comparator\TypeSensitiveEqualsComparisonStrategy;

class TypeSensitiveEqualsComparisonStrategyTest extends TestCase
{
    /**
     * @var TypeSensitiveEqualsComparisonStrategy
     */
    private $comparisonStrategy;

    protected function setUp()
    {
        $this->comparisonStrategy = new TypeSensitiveEqualsComparisonStrategy();
    }

    /**
     * @test
     * @dataProvider \Scheb\Comparator\Test\EqualsComparisonDataProvider::provideIdenticalValues
     */
    public function compare_identicalValues_valuesEqual($value1, $value2): void
    {
        $result = $this->comparisonStrategy->compare($value1, $value2);
        $this->assertTrue($result);
    }

    /**
     * @test
     * @dataProvider \Scheb\Comparator\Test\EqualsComparisonDataProvider::provideEqualButNotIdenticalValues
     */
    public function compare_noneIdenticalValues_valuesNotEqual($value1, $value2): void
    {
        $result = $this->comparisonStrategy->compare($value1, $value2);
        $this->assertFalse($result);
    }

    /**
     * @test
     * @dataProvider \Scheb\Comparator\Test\EqualsComparisonDataProvider::provideDefinitelyDifferentValues
     */
    public function compare_differentValues_valuesNotEqual($value1, $value2): void
    {
        $result = $this->comparisonStrategy->compare($value1, $value2);
        $this->assertFalse($result);
    }
}
