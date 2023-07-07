<?php

declare(strict_types=1);

namespace ExeQue\Remix\Compare\String;

use ExeQue\Remix\Assert;
use ExeQue\Remix\Compare\ComparatorInterface;
use ExeQue\Remix\Compare\Number\Max;

/**
 * Check if the length of a string is less than (or equal to) a given maximum
 *
 * Inclusive by default.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class LengthMax extends LengthComparator
{
    private ComparatorInterface $comparator;

    /**
     * @param  int  $length Maximum length
     * @param  bool  $inclusive Whether to include the maximum in the comparison (default: true)
     */
    public function __construct(int $length, bool $inclusive = true)
    {
        Assert::greaterThanEq($length, 0, 'Length must be greater than or equal to %2$s. Got: %s');

        $this->comparator = Max::make($length, $inclusive);
    }

    /**
     * @param  int  $length Maximum length
     * @param  bool  $inclusive Whether to include the maximum in the comparison (default: true)
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
