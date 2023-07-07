<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\Number\Math;

use ExeQue\Remix\Mutate\Number\NumberMutator;

/**
 * Add a number to a numeric value.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Add extends NumberMutator
{
    private int|float $addend;

    /**
     * @param  float|int  $addend The addend to add.
     */
    public function __construct(float|int $addend)
    {
        $this->addend = $addend;
    }

    /**
     * @param  float|int  $addend The addend to add.
     */
    public static function make(float|int $addend): self
    {
        return new self($addend);
    }

    protected function mutateNumber(float|int $value): float|int
    {
        return $value + $this->addend;
    }
}
