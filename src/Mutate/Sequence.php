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

    private array $sequence;

    /**
     * @param array $sequence The sequence to execute.
     */
    public function __construct(array $sequence = [])
    {
        $this->sequence = $this->resolveMutators($sequence);
    }

    /**
     * @param array $sequence The sequence to execute.
     */
    public static function make(array $sequence = []): self
    {
        return new self($sequence);
    }

    /**
     * Add mutator(s) to the sequence.
     *
     * @param callable ...$sequence The mutators to add.
     */
    public function then(callable ...$sequence): self
    {
        $this->sequence = array_merge($this->sequence, $this->resolveMutators($sequence));

        return $this;
    }

    /**
     * Add mutator(s) to the sequence that runs if a condition is met.
     *
     * @param callable|false $condition The condition to check.
     * @param callable|array $then The mutator(s) to run if the condition is met.
     * @param callable|array|null $otherwise The mutator(s) to run if the condition is not met.
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
        foreach ($this->sequence as $mutator) {
            $value = $mutator($value);
        }

        return $value;
    }
}
