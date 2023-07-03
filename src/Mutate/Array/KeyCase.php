<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\Array;

use ExeQue\Remix\Concerns\Definitions\TakesOnlyStringCasing;
use ExeQue\Remix\Mutate\String\Casing;

/**
 * Changes key casing of an array.
 *
 * @see Casing
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class KeyCase extends ArrayMutator
{
    use TakesOnlyStringCasing;

    protected function mutateArray(array $array): array
    {
        $caseMutator = new Casing($this->casing);

        $results = [];

        foreach ($array as $key => $value) {
            $results[$caseMutator->mutate($key)] = $value;
        }

        return $results;
    }
}
