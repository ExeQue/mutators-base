<?php

declare(strict_types=1);

namespace ExeQue\Mutators\String;

use ExeQue\Mutators\Mutator;
use Webmozart\Assert\Assert;

abstract class StringMutator extends Mutator
{
    final public function mutate(mixed $value): string
    {
        Assert::string($value, 'Value must be a string.');

        return $this->mutateString($value);
    }

    abstract protected function mutateString(string $value): string;
}
