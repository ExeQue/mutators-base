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

    /**
     * @param  array  $mutators The mutators to compound.
     */
    public function __construct(array $mutators = [])
    {
        $this->mutators = $this->resolveMutators($mutators);
    }

    /**
     * @param  array  $mutators The mutators to compound.
     */
    public static function make(array $mutators = []): self
    {
        return new self($mutators);
    }

    public function with(callable ...$mutators): self
    {
        $this->mutators = array_merge($this->mutators, $this->resolveMutators($mutators));

        return $this;
    }

    public function mutate(mixed $value): mixed
    {
        foreach ($this->mutators as $mutator) {
            $value = $mutator->mutate($value);
        }

        return $value;
    }
}
