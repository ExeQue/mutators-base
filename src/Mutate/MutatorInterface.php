<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate;

interface MutatorInterface
{
    public function __invoke(mixed $value): mixed;

    public function mutate(mixed $value): mixed;
}
