<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\Number;

use ExeQue\Remix\Assert;

/**
 * Round a number. By default, this will round to the nearest integer. The precision and mode can be set to change this.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Round extends NumberMutator
{
    private int $precision;
    private int $mode;

    /**
     * @param  int  $precision The precision to round to (default: 0). Only applies to RoundDirection::Normal.
     * @param  int  $mode The mode to round with (default: PHP_ROUND_HALF_UP). Only applies to RoundDirection::Normal.
     */
    public function __construct(int $precision = 0, int $mode = PHP_ROUND_HALF_UP)
    {
        Assert::greaterThanEq($precision, 0, 'Precision must be greater than or equal to 0.');

        $this->precision = $precision;
        $this->mode      = $mode;
    }

    /**
     * @param  int  $precision The precision to round to (default: 0). Only applies to RoundDirection::Normal.
     * @param  int  $mode The mode to round with (default: PHP_ROUND_HALF_UP). Only applies to RoundDirection::Normal.
     */
    public static function make(int $precision = 0, int $mode = PHP_ROUND_HALF_UP): self
    {
        return new self($precision, $mode);
    }

    protected function mutateNumber(float|int $value): float|int
    {
        return round($value, $this->precision, $this->mode);
    }
}
