<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\Convert;

use ExeQue\Remix\Concerns\Makes;
use ExeQue\Remix\Mutate\String\StringMutator;

/**
 * Converts a binary string to hexadecimal values.
 *
 * @see bin2hex()
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class BinToHex extends StringMutator
{
    use Makes;

    protected function mutateString(string $value): string
    {
        return bin2hex($value);
    }
}
