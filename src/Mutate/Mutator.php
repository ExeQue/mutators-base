<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate;

abstract class Mutator implements MutatorInterface
{
    final public function __invoke(mixed $value): mixed
    {
        return $this->mutate($value);
    }
}
