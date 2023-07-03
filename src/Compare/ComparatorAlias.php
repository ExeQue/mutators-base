<?php

declare(strict_types=1);

namespace ExeQue\Remix\Compare;

abstract class ComparatorAlias extends Comparator
{
    private ComparatorInterface $comparator;

    public function __construct(ComparatorInterface $comparator)
    {
        $this->comparator = $comparator;
    }

    final public function check(mixed $value): bool
    {
        return $this->comparator->check($value);
    }
}
