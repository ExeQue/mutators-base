<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\Convert;

use ExeQue\Remix\Concerns\Makes;
use ExeQue\Remix\Mutate\Mutator;

/**
 * Convert a value to a boolean.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class ToBool extends Mutator
{
    use Makes;

    public function mutate(mixed $value): bool
    {
        return (bool)$value;
    }
}
