<?php

declare(strict_types=1);

namespace ExeQue\Remix\Compare\Countable;

use ExeQue\Remix\Assert;
use ExeQue\Remix\Compare\ComparatorInterface;
use ExeQue\Remix\Compare\Number\Max;

/**
 * Check if the count of a value is less than (or equal to) a given maximum
 *
 * Inclusive by default.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class CountMax extends CountableComparator
{
    private ComparatorInterface $comparator;

    /**
     * @param  int  $max Maximum count
     * @param  bool  $inclusive Whether to include the maximum in the comparison
     */
    public function __construct(int $max, bool $inclusive = true)
    {
        Assert::greaterThanEq($max, 0, 'Max must be greater than or equal to %2$s. Got: %s');

        $this->comparator = Max::make($max, $inclusive);
    }

    /**
     * @param  int  $max Maximum count
     * @param  bool  $inclusive Whether to include the maximum in the comparison
     */
    public static function make(int $max, bool $inclusive = true): self
    {
        return new self($max, $inclusive);
    }

    protected function checkCount(int $count): bool
    {
        return $this->comparator->check($count);
    }
}
