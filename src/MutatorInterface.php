<?php

declare(strict_types=1);

namespace ExeQue\Mutators;

interface MutatorInterface
{
    public function __invoke(mixed $value): mixed;

    public function mutate(mixed $value): mixed;
}
