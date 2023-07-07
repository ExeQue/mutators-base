<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\Number\Math;

use ExeQue\Remix\Mutate\Number\NumberMutator;

/**
 * Subtract a number from another number.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Subtract extends NumberMutator
{
    private int|float $subtrahend;

    /**
     * @param  float|int  $subtrahend The subtrahend to subtract.
     */
    public function __construct(float|int $subtrahend)
    {
        $this->subtrahend = $subtrahend;
    }

    /**
     * @param  float|int  $subtrahend The subtrahend to subtract.
     */
    public static function make(float|int $subtrahend): self
    {
        return new self($subtrahend);
    }

    protected function mutateNumber(float|int $value): float|int
    {
        return $value - $this->subtrahend;
    }
}
