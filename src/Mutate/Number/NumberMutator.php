<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\Number;

use ExeQue\Remix\Assert;
use ExeQue\Remix\Mutate\Mutator;

abstract class NumberMutator extends Mutator
{
    public function mutate(mixed $value): float|int
    {
        Assert::numeric($value, 'Value must be numeric.');

        $value *= 1;

        return $this->mutateNumber($value);
    }

    abstract protected function mutateNumber(float|int $value): float|int;
}
