<?php

declare(strict_types=1);

namespace ExeQue\Mutators\Array;

use ExeQue\Mutators\Assert;
use ExeQue\Mutators\Concerns\Makes;
use ExeQue\Mutators\Mutator;

/**
 * Retrieve the first element of an array.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class First extends Mutator
{
    use Makes;

    public function mutate(mixed $value): mixed
    {
        Assert::isIterable($value, static::class . ' expects an iterable value');

        if (! is_array($value)) {
            $value = iterator_to_array($value);
        }

        return array_shift($value);
    }
}
