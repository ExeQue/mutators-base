<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate;

abstract class MutatorAlias extends Mutator
{
    private MutatorInterface $mutator;

    public function __construct(MutatorInterface $mutator)
    {
        $this->mutator = $mutator;
    }

    final public function mutate(mixed $value): mixed
    {
        return $this->mutator->mutate($value);
    }
}
