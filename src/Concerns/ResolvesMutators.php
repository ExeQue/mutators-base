<?php

declare(strict_types=1);

namespace ExeQue\Remix\Concerns;

use ExeQue\Remix\Exceptions\InvalidMutatorException;
use ExeQue\Remix\Mutate\CallbackMutator;
use ExeQue\Remix\Mutate\CompoundMutator;
use ExeQue\Remix\Mutate\MutatorInterface;
use function get_debug_type;

trait ResolvesMutators
{
    protected function resolveMutator(mixed $mutator): MutatorInterface
    {
        if ($mutator instanceof MutatorInterface) {
            return $mutator;
        }

        if (! is_string($mutator) && is_callable($mutator)) {
            return new CallbackMutator($mutator);
        }

        if (is_array($mutator)) {
            return new CompoundMutator($mutator);
        }

        throw new InvalidMutatorException(sprintf(
            'Invalid mutator - must be a non-string callable, array or instance of MutatorInterface. Got: %s',
            get_debug_type($mutator)
        ));
    }

    protected function resolveMutators(array $mutators): array
    {
        return array_map(fn ($mutator) => $this->resolveMutator($mutator), $mutators);
    }
}
