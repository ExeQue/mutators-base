<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\Array;

use ExeQue\Remix\Concerns\Makes;

/**
 * Retrieves all the values of an array
 *
 * @see array_values()
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Values extends ArrayMutator
{
    use Makes;

    protected function mutateArray(array $array): array
    {
        return array_values($array);
    }
}
