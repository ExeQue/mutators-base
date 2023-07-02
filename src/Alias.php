<?php

declare(strict_types=1);

namespace ExeQue\Mutators;

abstract class Alias extends Mutator
{
    private MutatorInterface $mutator;

    public function __construct(MutatorInterface $mutator)
    {
        $this->mutator = $mutator;
    }

    public function mutate(mixed $value): mixed
    {
        return $this->mutator->mutate($value);
    }
}
