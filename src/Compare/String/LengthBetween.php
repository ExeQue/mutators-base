<?php

declare(strict_types=1);

namespace ExeQue\Remix\Compare\String;

use ExeQue\Remix\Assert;
use ExeQue\Remix\Compare\ComparatorInterface;
use ExeQue\Remix\Compare\Logical\All;
use ExeQue\Remix\Compare\Number\Between;
use ExeQue\Remix\Compare\Number\Max;
use ExeQue\Remix\Compare\Number\Min;

/**
 * Checks if the length of a string is between a given minimum and maximum.
 *
 * Inclusive by default.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class LengthBetween extends LengthComparator
{
    private ComparatorInterface $comparator;

    /**
     * @param  int  $min Minimum length
     * @param  int  $max Maximum length
     * @param  bool  $inclusive Whether to include the minimum and maximum in the comparison
     */
    public function __construct(int $min, int $max, bool $inclusive = true)
    {
        $this->comparator = Between::make($min, $max, $inclusive);
    }

    /**
     * @param  int  $min Minimum length
     * @param  int  $max Maximum length
     * @param  bool  $inclusive Whether to include the minimum and maximum in the comparison
     */
    public static function make(int $min, int $max, bool $inclusive = true): self
    {
        return new self($min, $max, $inclusive);
    }

    protected function compareLength(int $length): bool
    {
        return $this->comparator->check($length);
    }
}
