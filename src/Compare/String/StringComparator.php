<?php

declare(strict_types=1);

namespace ExeQue\Remix\Compare\String;

use ExeQue\Remix\Assert;
use ExeQue\Remix\Compare\Comparator;

abstract class StringComparator extends Comparator
{
    /**
     * Compare the input string against the comparator.
     */
    final public function check(mixed $value): bool
    {
        Assert::string($value, 'Value must be a string.');

        return $this->checkString((string)$value);
    }

    /**
     * Compare the input string against the comparator.
     */
    abstract protected function checkString(string $value): bool;
}
