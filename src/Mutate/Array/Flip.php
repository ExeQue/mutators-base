<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\Array;

use ExeQue\Remix\Concerns\Makes;

/**
 * Exchanges all keys with their associated values in an arra
 *
 * @see array_flip()
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Flip extends ArrayMutator
{
    use Makes;

    protected function mutateArray(array $array): array
    {
        return array_flip($array);
    }
}
