<?php

declare(strict_types=1);

namespace ExeQue\Remix\Compare\String;

use ExeQue\Remix\Assert;
use ExeQue\Remix\Compare\ComparatorInterface;
use ExeQue\Remix\Compare\Number\Min;

/**
 * Check if the length of a string is greater than (or equal to) a given minimum
 *
 * Inclusive by default.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class LengthMin extends LengthComparator
{
    private ComparatorInterface $comparator;

    /**
     * @param  int  $length Minimum length
     * @param  bool  $inclusive Whether to include the minimum in the comparison (default: true)
     */
    public function __construct(int $length, bool $inclusive = true)
    {
        Assert::greaterThanEq($length, 0, 'Length must be greater than or equal to %2$s. Got: %s');

        $this->comparator = Min::make($length, $inclusive);
    }

    /**
     * @param  int  $length Minimum length
     * @param  bool  $inclusive Whether to include the minimum in the comparison (default: true)
     */
    public static function make(int $length, bool $inclusive = true): self
    {
        return new self($length, $inclusive);
    }

    protected function compareLength(int $length): bool
    {
        return $this->comparator->check($length);
    }
}
