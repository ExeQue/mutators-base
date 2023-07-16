<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\Array;

use ExeQue\Remix\Assert;
use ExeQue\Remix\Concerns\Makes;
use ExeQue\Remix\Mutate\Mutator;

/**
 * Collapse an array of arrays into a single array.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Collapse extends Mutator
{
    use Makes;

    public function mutate(mixed $value): array
    {
        Assert::isIterable($value, 'Value must be iterable. Got: %s');

        $results = [];

        foreach ($value as $values) {
            if(! is_array($values) && is_iterable($values)) {
                $values = iterator_to_array($values);
            }

            if (! is_array($values)) {
                continue;
            }

            $results[] = $values;
        }

        return array_merge([], ...$results);
    }
}
