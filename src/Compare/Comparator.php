<?php

declare(strict_types=1);

namespace ExeQue\Remix\Compare;

abstract class Comparator implements ComparatorInterface
{
    final public function __invoke(mixed $value): bool
    {
        return $this->check($value);
    }

    abstract public function check(mixed $value): bool;
}
