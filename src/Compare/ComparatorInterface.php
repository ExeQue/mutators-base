<?php

declare(strict_types=1);

namespace ExeQue\Remix\Compare;

interface ComparatorInterface
{
    /**
     * Compare the input value against the comparator.
     */
    public function __invoke(mixed $value): bool;

    /**
     * Compare the input value against the comparator.
     */
    public function check(mixed $value): bool;
}
