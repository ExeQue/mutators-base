<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate;

use ExeQue\Remix\Concerns\ResolvesMutators;

/**
 * Combine multiple mutators into one. The output of the first mutator is passed to the second mutator, and so on.
 *
 * Allowed mutators:
 * - Any mutator implementing the Mutator interface
 * - Any non-string callable
 * - Any array of mutators
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Sequence extends Mutator
{
    use ResolvesMutators;

    private array $mutators;

    /**
     * @param  array  $mutators The mutators to sequence.
     */
    public function __construct(array $mutators = [])
    {
        $this->mutators = $this->resolveMutators($mutators);
    }

    /**
     * @param  array  $mutators The mutators to sequence.
     */
    public static function make(array $mutators = []): self
    {
        return new self($mutators);
    }

    /**
     * Add mutator(s) to the sequence.
     *
     * @param  callable  ...$mutators The mutators to add.
     */
    public function then(callable ...$mutators): self
    {
        $this->mutators = array_merge($this->mutators, $this->resolveMutators($mutators));

        return $this;
    }

    /**
     * Add mutator(s) to the sequence that runs if a condition is met.
     *
     * @param  callable|false  $condition The condition to check.
     * @param  callable|array  $then The mutator(s) to run if the condition is met.
     * @param  callable|array|null  $otherwise The mutator(s) to run if the condition is not met.
     */
    public function when(callable|bool $condition, callable|array $then, callable|array $otherwise = null): self
    {
        if ($condition === false) {
            return $this->then($otherwise);
        }

        if ($condition === true) {
            return $this->then($then);
        }

        return $this->then(
            new When(
                $condition,
                $this->resolveMutator($then),
                $otherwise ? $this->resolveMutator($otherwise) : null
            )
        );
    }

    public function mutate(mixed $value): mixed
    {
        foreach ($this->mutators as $mutator) {
            $value = $mutator->mutate($value);
        }

        return $value;
    }
}
