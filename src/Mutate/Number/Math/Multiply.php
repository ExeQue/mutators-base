<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\Number\Math;

use ExeQue\Remix\Mutate\Number\NumberMutator;

/**
 * Multiply a number with a given multiplier.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Multiply extends NumberMutator
{
    private int|float $multiplier;

    /**
     * @param  float|int  $multiplier The multiplier to multiply with.
     */
    public function __construct(float|int $multiplier)
    {
        $this->multiplier = $multiplier;
    }

    /**
     * @param  float|int  $multiplier The multiplier to multiply with.
     */
    public static function make(float|int $multiplier): self
    {
        return new self($multiplier);
    }

    protected function mutateNumber(float|int $value): float|int
    {
        return $value * $this->multiplier;
    }
}
