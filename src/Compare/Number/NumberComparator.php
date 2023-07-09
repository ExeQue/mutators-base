<?php

declare(strict_types=1);

namespace ExeQue\Remix\Compare\Number;

use ExeQue\Remix\Assert;
use ExeQue\Remix\Compare\Comparator;

abstract class NumberComparator extends Comparator
{
    /**
     * Compare the input number against the comparator.
     */
    final public function check(mixed $value): bool
    {
        if (is_string($value) && is_numeric($value)) {
            $value = (float)$value;
        }

        Assert::intOrFloat($value, 'Value must be a number. Got: %s');

        return $this->checkNumber($value);
    }

    /**
     * Compare the input number against the comparator.
     */
    abstract protected function checkNumber(int|float $value): bool;
}
