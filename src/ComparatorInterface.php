<?php

namespace Scheb\Comparator;

interface ComparatorInterface
{
    /**
     * Compare two values if they're equal.
     *
     * @param mixed $value1
     * @param mixed $value2
     *
     * @return bool
     */
    public function isEqual($value1, $value2): bool;
}
