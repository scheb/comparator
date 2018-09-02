<?php

namespace Scheb\Comparator;

class TypeSensitiveEqualsComparisonStrategy implements ValueComparisonStrategyInterface
{
    public function compare($value1, $value2): bool
    {
        return $value1 === $value2;
    }
}
