<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate;

use ExeQue\Remix\Compare\ComparatorInterface;
use ExeQue\Remix\Concerns\ResolvesComparators;
use ExeQue\Remix\Concerns\ResolvesMutators;

/**
 * If the condition is true, executes `$then` or `$otherwise` (if set).
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class When extends Mutator
{
    use ResolvesComparators;
    use ResolvesMutators;

    private ComparatorInterface $condition;
    private MutatorInterface $then;
    private ?MutatorInterface $otherwise = null;

    /**
     * @param  callable|bool  $condition The condition to check - If a callable is provided, it will be called with the value to check as the first argument.
     * @param  callable|array  $then The mutator to execute if the condition is true.
     * @param  callable|array|null  $otherwise The mutator to execute if the condition is false (optional).
     */
    public function __construct(callable|bool $condition, callable|array $then, callable|array $otherwise = null)
    {
        $this->condition = $this->resolveComparator($condition);
        $this->then      = $this->resolveMutator($then);

        if ($otherwise !== null) {
            $this->otherwise = $this->resolveMutator($otherwise);
        }
    }

    /**
     * @param  callable|bool  $condition The condition to check - If a callable is provided, it will be called with the value to check as the first argument.
     * @param  callable|array  $then The mutator to execute if the condition is true.
     * @param  callable|array|null  $otherwise The mutator to execute if the condition is false (optional).
     */
    public static function make(callable|bool $condition, callable|array $then, callable|array $otherwise = null): self
    {
        return new self($condition, $then, $otherwise);
    }

    public function mutate(mixed $value): mixed
    {
        if ($this->condition->check($value)) {
            return $this->then->mutate($value);
        }

        if ($this->otherwise !== null) {
            return $this->otherwise->mutate($value);
        }

        return $value;
    }
}
