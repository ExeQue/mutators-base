<?php

declare(strict_types=1);

namespace ExeQue\Mutators\String;

use ExeQue\Mutators\Assert;
use ExeQue\Mutators\Comparator;

abstract class StringComparator extends Comparator
{
    protected function compare(mixed $value): bool
    {
        Assert::string($value, 'Value must be a string.');

        return $this->compareString((string)$value);
    }

    abstract protected function compareString(string $value): bool;
}
