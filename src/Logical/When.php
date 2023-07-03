<?php

declare(strict_types=1);

namespace ExeQue\Mutators\Logical;

use ExeQue\Mutators\Concerns\ResolvesComparators;
use ExeQue\Mutators\Concerns\ResolvesMutators;
use ExeQue\Mutators\Mutator;
use ExeQue\Mutators\MutatorInterface;

/**
 * If the condition is true, executes `$then` or `$otherwise` (if set).
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class When extends Mutator
{
    use ResolvesComparators;
    use ResolvesMutators;

    private MutatorInterface $condition;
    private MutatorInterface $then;
    private ?MutatorInterface $otherwise = null;

    public function __construct(callable|bool $condition, callable|array $then, callable|array $otherwise = null)
    {
        $this->condition = $this->resolveComparator($condition);
        $this->then      = $this->resolveMutator($then);

        if ($otherwise !== null) {
            $this->otherwise = $this->resolveMutator($otherwise);
        }
    }

    public static function make(callable|bool $condition, callable|array $then, callable|array $otherwise = null): self
    {
        return new self($condition, $then, $otherwise);
    }

    public function mutate(mixed $value): mixed
    {
        if ($this->condition->mutate($value)) {
            return $this->then->mutate($value);
        }

        if ($this->otherwise !== null) {
            return $this->otherwise->mutate($value);
        }

        return $value;
    }
}
