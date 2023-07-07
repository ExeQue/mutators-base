<?php

declare(strict_types=1);

namespace ExeQue\Remix\Compare\Number;

/**
 * Checks if number (int or float) is less than (or equal to) a given number.
 *
 * Inclusive by default.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Max extends NumberComparator
{
    private int $max;
    private bool $inclusive;

    /**
     * @param  int  $max The maximum value
     * @param  bool  $inclusive Whether to include the maximum value
     */
    public function __construct(int $max, bool $inclusive = true)
    {
        $this->max       = $max;
        $this->inclusive = $inclusive;
    }

    /**
     * @param  int  $max The maximum value
     * @param  bool  $inclusive Whether to include the maximum value
     */
    public static function make(int $max, bool $inclusive = true): self
    {
        return new self($max, $inclusive);
    }

    protected function checkNumber(float|int $value): bool
    {
        if ($this->inclusive) {
            return $value <= $this->max;
        }

        return $value < $this->max;
    }
}
