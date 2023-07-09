<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\Number\Math;

use ExeQue\Remix\Mutate\Number\NumberMutator;

/**
 * Raise a number to a given exponent.
 */
class Pow extends NumberMutator
{
    private int|float $exponent;

    /**
     * @param float|int $exponent The exponent to raise to.
     */
    public function __construct(float|int $exponent)
    {
        $this->exponent = $exponent;
    }

    /**
     * @param float|int $exponent The exponent to raise to.
     */
    public static function make(float|int $exponent): self
    {
        return new self($exponent);
    }

    public static function square(): Pow
    {
        return self::make(2);
    }

    public static function cube(): Pow
    {
        return self::make(3);
    }

    protected function mutateNumber(float|int $value): float|int
    {
        return $value ** $this->exponent;
    }
}
