<?php

declare(strict_types=1);

namespace ExeQue\Remix\Compare\Array;

use ExeQue\Remix\Compare\Comparator;
use ExeQue\Remix\Concerns\Makes;

/**
 * Checks if an array is empty.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class IsEmpty extends Comparator
{
    use Makes;

    public function check(mixed $value): bool
    {
        if (! is_array($value) && is_iterable($value)) {
            $value = iterator_to_array($value);
        }

        return empty($value);
    }
}
