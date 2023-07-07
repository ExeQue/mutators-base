<?php

declare(strict_types=1);

namespace ExeQue\Remix\Compare\Array;

use ExeQue\Remix\Concerns\Makes;

/**
 * Checks if an array is empty.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class IsEmpty extends ArrayComparator
{
    use Makes;

    /**
     * Check if the array is empty.
     */
    protected function checkArray(array $value): bool
    {
        return empty($value);
    }
}
