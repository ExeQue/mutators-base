<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\String;

use ExeQue\Remix\Mutate\Mutator;
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
