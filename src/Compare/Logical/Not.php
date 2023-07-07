<?php

declare(strict_types=1);

namespace ExeQue\Remix\Compare\Logical;

use ExeQue\Remix\Compare\Comparator;
use ExeQue\Remix\Compare\ComparatorInterface;
use ExeQue\Remix\Concerns\ResolvesComparators;

/**
 * Inverts the result of a mutator.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Not extends Comparator
{
    use ResolvesComparators;

    private ComparatorInterface $comparator;

    /**
     * @param  callable|bool  $comparator A comparator or a boolean value to invert
     */
    public function __construct(callable|bool $comparator)
    {
        $this->comparator = $this->resolveComparator($comparator);
    }

    /**
     * @param  callable|bool  $comparator A comparator or a boolean value to invert
     */
    public static function make(callable|bool $comparator): self
    {
        return new self($comparator);
    }

    public function check(mixed $value): bool
    {
        return ! $this->comparator->check($value);
    }
}
