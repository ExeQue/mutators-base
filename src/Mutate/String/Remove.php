<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\String;

use ExeQue\Remix\Mutate\MutatorAlias;

/**
 * Removes all occurrences of the given string from the input string.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Remove extends MutatorAlias
{
    public function __construct(array|string $search, bool $caseSensitive = true)
    {
        parent::__construct(new Replace($search, '', $caseSensitive));
    }

    public static function make(array|string $search, bool $caseSensitive = true): self
    {
        return new self($search, $caseSensitive);
    }
}
