<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\Array;

use ExeQue\Remix\Assert;
use ExeQue\Remix\Mutate\Mutator;

abstract class ArrayMutator extends Mutator
{
    public function mutate(mixed $value): array
    {
        Assert::isIterable($value, static::class . ' expects an iterable value');

        if (! is_array($value)) {
            $value = iterator_to_array($value);
        }

        return $this->mutateArray($value);
    }

    abstract protected function mutateArray(array $array): array;
}
