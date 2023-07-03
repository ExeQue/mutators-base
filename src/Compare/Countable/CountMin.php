<?php

declare(strict_types=1);

namespace ExeQue\Remix\Compare\Countable;

use ExeQue\Remix\Assert;
use ExeQue\Remix\Compare\ComparatorInterface;
use ExeQue\Remix\Compare\Number\Min;

/**
 * Check if the count of a value is greater than (or equal to) a given minimum
 *
 * Inclusive by default.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class CountMin extends CountableComparator
{
    private ComparatorInterface $comparator;

    public function __construct(int $min, bool $inclusive = true)
    {
        Assert::greaterThanEq($min, 0, 'Min must be greater than or equal to %2$s. Got: %s');

        $this->comparator = Min::make($min, $inclusive);
    }

    public static function make(int $min, bool $inclusive = true): self
    {
        return new self($min, $inclusive);
    }

    protected function checkCount(int $count): bool
    {
        return $this->comparator->check($count);
    }
}
