<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate;

use ExeQue\Remix\Concerns\ResolvesMutators;

/**
 * Compounds multiple mutators into one. The output of the first mutator is passed to the second mutator, and so on.
 *
 * Allowed mutators:
 * - Any mutator implementing the Mutator interface
 * - Any non-string callable
 * - Any array of mutators
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class CompoundMutator extends Mutator
{
    use ResolvesMutators;

    private array $mutators;

    public function __construct(array $mutators)
    {
        $this->mutators = $this->resolveMutators($mutators);
    }

    public static function make(array $mutators): self
    {
        return new self($mutators);
    }

    public function mutate(mixed $value): mixed
    {
        foreach ($this->mutators as $mutator) {
            $value = $mutator->mutate($value);
        }

        return $value;
    }
}
