<?php

declare(strict_types=1);

namespace ExeQue\Remix\Compare\Array;

use ExeQue\Remix\Assert;
use ExeQue\Remix\Compare\Comparator;

abstract class ArrayComparator extends Comparator
{
    /**
     * Compare the input value against the comparator.
     *
     * @param  array  $value
     */
    final public function check(mixed $value): bool
    {
        Assert::isIterable($value, 'Value must be an array. Got: %s');

        if (! is_array($value)) {
            $value = iterator_to_array($value);
        }

        return $this->checkArray($value);
    }

    /**
     * Compare the array against the comparator.
     */
    abstract protected function checkArray(array $value): bool;
}
