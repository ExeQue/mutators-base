<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\Convert;

use ExeQue\Remix\Concerns\Makes;
use ExeQue\Remix\Exceptions\InvalidArgumentException;
use ExeQue\Remix\Mutate\Mutator;

/**
 * Converts a value to an integer.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class ToInt extends Mutator
{
    use Makes;

    public function mutate(mixed $value): int
    {
        if (is_array($value)) {
            throw new InvalidArgumentException('Cannot convert array to an integer');
        }

        if (is_object($value)) {
            throw new InvalidArgumentException('Cannot convert object to an integer');
        }

        if (is_resource($value)) {
            throw new InvalidArgumentException('Cannot convert resource to an integer');
        }

        return (int)$value;
    }
}
