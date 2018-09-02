<?php

namespace Scheb\Comparator;

class CallbackComparisonStrategy implements ValueComparisonStrategyInterface
{
    /**
     * @var callable
     */
    private $callback;

    public function __construct(callable $callback)
    {
        $this->callback = $callback;
    }

    public function compare($value1, $value2): bool
    {
        return call_user_func($this->callback, $value1, $value2);
    }
}
