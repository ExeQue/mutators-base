<?php

declare(strict_types=1);

namespace ExeQue\Remix\Compare\Array;

use ArrayAccess;
use ExeQue\Remix\Compare\Comparator;
use ExeQue\Remix\Concerns\Makes;

/**
 * Check if a value is an array or an ArrayAccess object.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Accessible extends Comparator
{
    use Makes;

    public function check(mixed $value): bool
    {
        return is_array($value) || $value instanceof ArrayAccess;
    }
}
