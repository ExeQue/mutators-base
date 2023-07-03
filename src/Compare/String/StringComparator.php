<?php

declare(strict_types=1);

namespace ExeQue\Remix\Compare\String;

use ExeQue\Remix\Assert;
use ExeQue\Remix\Compare\Comparator;

abstract class StringComparator extends Comparator
{
    public function check(mixed $value): bool
    {
        Assert::string($value, 'Value must be a string.');

        return $this->compareString((string)$value);
    }

    abstract protected function compareString(string $value): bool;
}
