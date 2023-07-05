<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\Convert;

use ExeQue\Remix\Concerns\Makes;
use ExeQue\Remix\Exceptions\InvalidArgumentException;
use ExeQue\Remix\Mutate\Mutator;
use Stringable;

/**
 * Converts a value to a string.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class ToString extends Mutator
{
    use Makes;

    public function mutate(mixed $value): string
    {
        if (is_array($value)) {
            throw new InvalidArgumentException('Cannot convert array to string');
        }

        if (is_object($value) && ! $value instanceof Stringable) {
            throw new InvalidArgumentException('Cannot convert object to string');
        }

        if (is_resource($value)) {
            throw new InvalidArgumentException('Cannot convert resource to string');
        }

        return (string)$value;
    }
}
