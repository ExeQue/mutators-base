<?php

declare(strict_types=1);

namespace ExeQue\Mutators\Logical;

use ExeQue\Mutators\Comparator;
use ExeQue\Mutators\Concerns\ResolvesComparators;
use ExeQue\Mutators\MutatorInterface;

/**
 * Inverts the result of a mutator.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Not extends Comparator
{
    use ResolvesComparators;

    private MutatorInterface $comparator;

    public function __construct(callable|bool $comparator)
    {
        $this->comparator = $this->resolveComparator($comparator);
    }

    public static function make(callable|bool $comparator): self
    {
        return new self($comparator);
    }

    protected function compare(mixed $value): bool
    {
        return ! $this->comparator->mutate($value);
    }
}
