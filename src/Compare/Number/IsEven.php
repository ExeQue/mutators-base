<?php

declare(strict_types=1);

namespace ExeQue\Remix\Compare\Number;

use ExeQue\Remix\Concerns\Makes;

/**
 * Checks if a number is even.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class IsEven extends NumberComparator
{
    use Makes;

    protected function checkNumber(float|int $value): bool
    {
        return (int)$value % 2 === 0;
    }
}
