<?php

declare(strict_types=1);

namespace ExeQue\Mutators;

abstract class Comparator implements ComparatorInterface
{
    final public function __invoke(mixed $value): bool
    {
        return $this->mutate($value);
    }

    final public function mutate(mixed $value): bool
    {
        return $this->compare($value);
    }

    abstract protected function compare(mixed $value): bool;
}
