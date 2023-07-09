<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\Number\Math;

use ExeQue\Remix\Mutate\Number\NumberMutator;

/**
 * Calculate the modulo of a number.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Modulo extends NumberMutator
{
    private int|float $divisor;

    /**
     * @param float|int $divisor The divisor to divide with.
     */
    public function __construct(float|int $divisor)
    {
        $this->divisor = $divisor;
    }

    /**
     * @param float|int $divisor The divisor to divide with.
     */
    public static function make(float|int $divisor): self
    {
        return new self($divisor);
    }

    protected function mutateNumber(float|int $value): float|int
    {
        return $value % $this->divisor;
    }
}
