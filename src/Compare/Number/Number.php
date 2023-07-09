<?php

declare(strict_types=1);

namespace ExeQue\Remix\Compare\Number;

use ExeQue\Remix\Assert;

/**
 * Check if the input matches the min and max values.
 * If min and max are equal, the count must match that value regardless of the inclusive flag.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Number extends NumberComparator
{
    private int|float|null $min;
    private int|float|null $max;
    private bool $inclusive;

    /**
     * @param  int|float|null  $min Minimum. Null means no minimum.
     * @param  int|float|null  $max Maximum. Null means no maximum.
     * @param  bool  $inclusive Whether to include the minimum and maximum in the comparison (default: true)
     */
    public function __construct(int|float $min = null, int|float $max = null, bool $inclusive = true)
    {
        if ($min !== null && $max !== null) {
            Assert::greaterThanEq($max, $min, 'Max must be greater than or equal to %2$s. Got: %s');
        }

        if ($min === null && $max === null) {
            Assert::report('Min and max cannot both be null');
        }

        $this->min       = $min;
        $this->max       = $max;
        $this->inclusive = $inclusive || $min === $max;
    }

    /**
     * @param  int|float|null  $min Minimum. Null means no minimum.
     * @param  int|float|null  $max Maximum. Null means no maximum.
     * @param  bool  $inclusive Whether to include the minimum and maximum in the comparison (default: true)
     */
    public static function make(int|float $min = null, int|float $max = null, bool $inclusive = true): self
    {
        return new self($min, $max, $inclusive);
    }

    /**
     * Must be equal to the given size.
     *
     * @param  int|float  $size Size to compare to
     */
    public static function equal(int|float $size): self
    {
        return self::make($size, $size);
    }

    /**
     * Must be greater than or equal to the given minimum.
     *
     * @param  int|float  $min Minimum count
     * @param  bool  $inclusive Whether to include the minimum and maximum in the comparison (default: true)
     */
    public static function min(int|float $min, bool $inclusive = true): self
    {
        return self::make($min, null, $inclusive);
    }

    /**
     * Must be less than or equal to the given maximum.
     *
     * @param  int  $max Maximum count
     * @param  bool  $inclusive Whether to include the minimum and maximum in the comparison (default: true)
     */
    public static function max(int|float $max, bool $inclusive = true): self
    {
        return self::make(null, $max, $inclusive);
    }

    /**
     * Must be between the given minimum and maximum.
     *
     * @param  int|float  $min Minimum count
     * @param  int|float  $max Maximum count
     * @param  bool  $inclusive Whether to include the minimum and maximum in the comparison (default: true)
     */
    public static function between(int|float $min, int|float $max, bool $inclusive = true): self
    {
        return self::make($min, $max, $inclusive);
    }

    protected function checkNumber(int|float $value): bool
    {
        if ($this->min !== null && $this->max !== null) {
            return $this->checkBetween($value);
        }

        if ($this->min !== null) {
            return $this->checkMin($value);
        }

        if ($this->max !== null) {
            return $this->checkMax($value);
        }
    }

    private function checkBetween(int|float $value): bool
    {
        return $this->checkMin($value) && $this->checkMax($value);
    }

    private function checkMin(int|float $value): bool
    {
        if ($this->inclusive) {
            return $value >= $this->min;
        }

        return $value > $this->min;
    }

    private function checkMax(int|float $value): bool
    {
        if ($this->inclusive) {
            return $value <= $this->max;
        }

        return $value < $this->max;
    }
}
