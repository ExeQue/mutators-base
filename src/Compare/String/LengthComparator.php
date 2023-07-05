<?php

declare(strict_types=1);

namespace ExeQue\Remix\Compare\String;

abstract class LengthComparator extends StringComparator
{
    final protected function checkString(string $value): bool
    {
        return $this->compareLength(mb_strlen($value));
    }

    abstract protected function compareLength(int $length): bool;
}
