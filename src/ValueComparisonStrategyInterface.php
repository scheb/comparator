<?php

namespace Scheb\Comparator;

interface ValueComparisonStrategyInterface
{
    /**
     * Compare two values if they're equal.
     *
     * @param mixed $value1
     * @param mixed $value2
     *
     * @return bool
     */
    public function compare($value1, $value2): bool;
}
