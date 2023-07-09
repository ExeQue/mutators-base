<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\Number;

use ExeQue\Remix\Assert;

/**
 * Rounds a number down. Optionally with a given precision.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Floor extends NumberMutator
{
    private int $precision;

    /**
     * @param int $precision The precision to round to.
     */
    public function __construct(int $precision = 0)
    {
        Assert::greaterThanEq($precision, 0, 'Precision must be greater than or equal to 0.');

        $this->precision = $precision;
    }

    /**
     * @param int $precision The precision to round to.
     */
    public static function make(int $precision = 0): self
    {
        return new self($precision);
    }

    protected function mutateNumber(float|int $value): float|int
    {
        if ($this->precision === 0) {
            return floor($value);
        }

        $multiplier = 10 ** $this->precision;

        return floor($value * $multiplier) / $multiplier;
    }
}
