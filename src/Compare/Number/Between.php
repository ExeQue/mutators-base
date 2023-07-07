<?php

declare(strict_types=1);

namespace ExeQue\Remix\Compare\Number;

use ExeQue\Remix\Assert;
use ExeQue\Remix\Compare\Logical\All;

/**
 * Checks if a number is between a given minimum and maximum.
 *
 * Inclusive by default.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Between extends NumberComparator
{
    private All $comparator;

    /**
     * @param  int  $min Minimum
     * @param  int  $max Maximum
     * @param  bool  $inclusive Whether to include the minimum and maximum in the comparison
     */
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

    /**
     * @param  int  $min Minimum
     * @param  int  $max Maximum
     * @param  bool  $inclusive Whether to include the minimum and maximum in the comparison
     */
    public static function make(int $min, int $max, bool $inclusive = true): self
    {
        return new self($min, $max, $inclusive);
    }

    protected function checkNumber(float|int $value): bool
    {
        return $this->comparator->check($value);
    }
}
