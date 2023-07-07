<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\String;

use ExeQue\Remix\Concerns\ResolvesStringInput;
use ExeQue\Remix\Mutate\Mutator;

abstract class StringMutator extends Mutator
{
    use ResolvesStringInput;

    final public function mutate(mixed $value): string
    {
        $value = $this->resolveStringInput($value);

        return $this->mutateString($value);
    }

    abstract protected function mutateString(string $value): string;
}
