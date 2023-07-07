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
    /**
     * @param  array|string  $search The value(s) to search for.
     * @param  bool  $caseSensitive Whether to perform a case-sensitive search (default: true).
     */
    public function __construct(array|string $search, bool $caseSensitive = true)
    {
        parent::__construct(new Replace($search, '', $caseSensitive));
    }

    /**
     * @param  array|string  $search The value(s) to search for.
     * @param  bool  $caseSensitive Whether to perform a case-sensitive search (default: true).
     */
    public static function make(array|string $search, bool $caseSensitive = true): self
    {
        return new self($search, $caseSensitive);
    }
}
