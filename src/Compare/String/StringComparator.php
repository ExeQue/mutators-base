<?php

declare(strict_types=1);

namespace ExeQue\Remix\Compare\String;

use ExeQue\Remix\Assert;
use ExeQue\Remix\Compare\Comparator;

abstract class StringComparator extends Comparator
{
    final public function check(mixed $value): bool
    {
        Assert::string($value, 'Value must be a string.');

        return $this->checkString((string)$value);
    }

    abstract protected function checkString(string $value): bool;
}
