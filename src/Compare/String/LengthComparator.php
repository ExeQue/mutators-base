<?php

declare(strict_types=1);

namespace ExeQue\Remix\Compare\String;

abstract class LengthComparator extends StringComparator
{
    /**
     * Compare the input string against the comparator.
     */
    final protected function checkString(string $value): bool
    {
        return $this->compareLength(mb_strlen($value));
    }

    /**
     * Compare the input length against the comparator.
     */
    abstract protected function compareLength(int $length): bool;
}
