<?php

declare(strict_types=1);

namespace ExeQue\Mutators;

interface ComparatorInterface extends MutatorInterface
{
    public function mutate(mixed $value): bool;
}
