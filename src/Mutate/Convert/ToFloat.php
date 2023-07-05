<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\Convert;

use ExeQue\Remix\Concerns\Makes;
use ExeQue\Remix\Exceptions\InvalidArgumentException;
use ExeQue\Remix\Mutate\Mutator;

/**
 * Convert a value to a float.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class ToFloat extends Mutator
{
    use Makes;

    public function mutate(mixed $value): float
    {
        if (is_array($value)) {
            throw new InvalidArgumentException('Cannot convert array to a float');
        }

        if (is_object($value)) {
            throw new InvalidArgumentException('Cannot convert object to a float');
        }

        if (is_resource($value)) {
            throw new InvalidArgumentException('Cannot convert resource to a float');
        }

        return (float)$value;
    }
}
