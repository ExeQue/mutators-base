<?php

declare(strict_types=1);

namespace ExeQue\Mutators\Array;

use ExeQue\Mutators\Assert;
use ExeQue\Mutators\Concerns\Makes;
use ExeQue\Mutators\Mutator;

/**
 * Returns the last element of an array.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Last extends Mutator
{
    use Makes;

    public function mutate(mixed $value): mixed
    {
        Assert::isIterable($value, static::class . ' expects an iterable value');

        if (! is_array($value)) {
            $value = iterator_to_array($value);
        }

        return array_pop($value);
    }
}
