<?php

declare(strict_types=1);

namespace ExeQue\Remix\Compare\Array;

use ExeQue\Remix\Concerns\Makes;

/**
 * Checks if an array is a list.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class IsList extends ArrayComparator
{
    use Makes;

    protected function checkArray(array $value): bool
    {
        return array_is_list($value);
    }
}
