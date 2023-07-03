<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\Array;

use ExeQue\Remix\Concerns\Makes;
use ExeQue\Remix\Mutate\Mutator;

/**
 * Wraps a value in an array (if it isn't already an array)
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Wrap extends Mutator
{
    use Makes;

    public function mutate(mixed $value): array
    {
        return (array)$value;
    }
}
