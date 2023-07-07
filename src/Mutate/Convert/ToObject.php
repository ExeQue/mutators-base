<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\Convert;

use ExeQue\Remix\Concerns\Makes;
use ExeQue\Remix\Mutate\Mutator;

/**
 * Converts a value to an object.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class ToObject extends Mutator
{
    use Makes;

    public function mutate(mixed $value): object
    {
        return (object)$value;
    }
}
