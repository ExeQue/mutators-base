<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate;

interface MutatorInterface
{
    /**
     * Mutate the input value.
     */
    public function __invoke(mixed $value): mixed;

    /**
     * Mutate the input value.
     */
    public function mutate(mixed $value): mixed;
}
