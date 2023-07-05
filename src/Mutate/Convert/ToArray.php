<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\Convert;

use ExeQue\Remix\Concerns\Makes;
use ExeQue\Remix\Mutate\Mutator;

/**
 * Convert the input to an array,
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class ToArray extends Mutator
{
    use Makes;

    public function mutate(mixed $value): array
    {
        if (is_array($value)) {
            return $value;
        }

        if (is_iterable($value)) {
            return iterator_to_array($value);
        }

        if (is_object($value)) {
            return [$value];
        }

        return (array)$value;
    }
}
