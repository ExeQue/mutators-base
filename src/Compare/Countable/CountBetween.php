<?php

declare(strict_types=1);

namespace ExeQue\Remix\Compare\Countable;

use ExeQue\Remix\Compare\ComparatorInterface;
use ExeQue\Remix\Compare\Number\Between;

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

    /**
     * @param  int  $min Minimum count
     * @param  int  $max Maximum count
     * @param  bool  $inclusive Whether to include the minimum and maximum in the comparison (default: true)
     */
    public function __construct(int $min, int $max, bool $inclusive = true)
    {
        $this->comparator = Between::make($min, $max, $inclusive);
    }

    /**
     * @param  int  $min Minimum count
     * @param  int  $max Maximum count
     * @param  bool  $inclusive Whether to include the minimum and maximum in the comparison (default: true)
     */
    public static function make(int $min, int $max, bool $inclusive = true): self
    {
        return new self($min, $max, $inclusive);
    }

    protected function checkCount(int $count): bool
    {
        return $this->comparator->check($count);
    }
}
