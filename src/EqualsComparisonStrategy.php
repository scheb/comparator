<?php

namespace Scheb\Comparator;

class EqualsComparisonStrategy implements ValueComparisonStrategyInterface
{
    public function compare($value1, $value2): bool
    {
        if ($this->isPrimitiveValue($value1) !== $this->isPrimitiveValue($value2)) {
            return false;
        }

        return $value1 == $value2;
    }

    private function isPrimitiveValue($value): bool
    {
        return is_null($value) || is_scalar($value);
    }
}
