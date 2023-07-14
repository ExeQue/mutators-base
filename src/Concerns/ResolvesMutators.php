<?php

declare(strict_types=1);

namespace ExeQue\Remix\Concerns;

use ExeQue\Remix\Assert;
use ExeQue\Remix\Mutate\MutatesUsing;
use ExeQue\Remix\Mutate\MutatorInterface;
use ExeQue\Remix\Mutate\Sequence;

trait ResolvesMutators
{
    protected function resolveMutator(mixed $mutator): MutatorInterface
    {
        if ($mutator instanceof MutatorInterface) {
            return $mutator;
        }

        if (! is_string($mutator) && is_callable($mutator)) {
            return new MutatesUsing($mutator);
        }

        if (is_array($mutator)) {
            return new Sequence($mutator);
        }

        Assert::report('Invalid mutator - must be a non-string callable, array or instance of MutatorInterface. Got: %s', $mutator);
    }

    protected function resolveMutators(array $mutators): array
    {
        return array_values(array_map(fn ($mutator) => $this->resolveMutator($mutator), $mutators));
    }
}
