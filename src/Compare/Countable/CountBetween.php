<?php

declare(strict_types=1);

namespace ExeQue\Remix\Compare\Countable;

use ExeQue\Remix\Assert;
use ExeQue\Remix\Compare\ComparatorInterface;
use ExeQue\Remix\Compare\Logical\All;
use ExeQue\Remix\Compare\Number\Max;
use ExeQue\Remix\Compare\Number\Min;

/**
 * Checks if the count of a value is between a given minimum and maximum.
 *
 * Inclusive by default.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class CountBetween extends CountableComparator
{
    private ComparatorInterface $comparator;

    public function __construct(int $min, int $max, bool $inclusive = true)
    {
        Assert::greaterThanEq($min, 0, 'Min must be greater than or equal to %2$s. Got: %s');
        Assert::greaterThanEq($max, 0, 'Max must be greater than or equal to %2$s. Got: %s');
        Assert::greaterThanEq($max, $min, 'Max must be greater than or equal to %2$s. Got: %s');

        $this->comparator = All::make(
            Min::make($min, $inclusive),
            Max::make($max, $inclusive)
        );
    }

    public static function make(int $min, int $max, bool $inclusive = true): self
    {
        return new self($min, $max, $inclusive);
    }

    protected function checkCount(int $count): bool
    {
        return $this->comparator->check($count);
    }
}
