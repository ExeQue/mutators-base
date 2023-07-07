<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\Number;

use ExeQue\Remix\Concerns\Makes;

/**
 * Calculate the absolute value of a number.
 *
 * @see abs()
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Abs extends NumberMutator
{
    use Makes;

    protected function mutateNumber(float|int $value): float|int
    {
        return abs($value);
    }
}
