<?php

namespace Scheb\Comparator;

class Comparator implements ComparatorInterface
{
    /**
     * @var array
     */
    private $comparisonStrategies;

    /**
     * @param bool $useTypeSensitiveOperator if the equals (==) or type-sensitive (===) operation should be used.
     * @param ValueComparisonStrategyInterface[] $customComparisonStrategies
     */
    public function __construct(bool $useTypeSensitiveOperator = true, array $customComparisonStrategies = [])
    {
        $this->comparisonStrategies = $customComparisonStrategies;
        if ($useTypeSensitiveOperator) {
            $this->comparisonStrategies[] = new TypeSensitiveEqualsComparisonStrategy();
        } else {
            $this->comparisonStrategies[] = new EqualsComparisonStrategy();
        }
    }

    public function isEqual($value1, $value2): bool
    {
        foreach ($this->comparisonStrategies as $comparisonStrategy) {
            if ($comparisonStrategy->compare($value1, $value2)) {
                return true;
            }
        }

        return false;
    }
}
