<?php

declare(strict_types=1);

namespace ExeQue\Remix\Compare\Number;

use ExeQue\Remix\Assert;
use ExeQue\Remix\Compare\Comparator;

abstract class NumberComparator extends Comparator
{
    final public function check(mixed $value): bool
    {
        Assert::intOrFloat($value, 'Value must be a number. Got: %s');

        return $this->checkNumber($value);
    }

    abstract protected function checkNumber(int|float $value): bool;
}
