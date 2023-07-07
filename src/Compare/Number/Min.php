<?php

declare(strict_types=1);

namespace ExeQue\Remix\Compare\Number;

/**
 * Checks if number (int or float) is greater than (or equal to) a given number.
 *
 * Inclusive by default.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Min extends NumberComparator
{
    private int $min;
    private bool $inclusive;

    /**
     * @param  int  $min The minimum value
     * @param  bool  $inclusive Whether to include the minimum value (default: true)
     */
    public function __construct(int $min, bool $inclusive = true)
    {
        $this->min       = $min;
        $this->inclusive = $inclusive;
    }

    /**
     * @param  int  $min The minimum value
     * @param  bool  $inclusive Whether to include the minimum value (default: true)
     */
    public static function make(int $min, bool $inclusive = true): self
    {
        return new self($min, $inclusive);
    }

    protected function checkNumber(float|int $value): bool
    {
        if ($this->inclusive) {
            return $value >= $this->min;
        }

        return $value > $this->min;
    }
}
