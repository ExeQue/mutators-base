<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\String;

/**
 * Replace the first occurrence of the search string with the replacement string.
 *
 * Ported from `illuminate/support` to prevent package collisions.
 *
 * @see https://laravel.com/api/10.x/Illuminate/Support/Str.html#method_replaceFirst
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class ReplaceFirst extends StringMutator
{
    private string $search;
    private string $replace;

    /**
     * @param  string  $search The value to search for.
     * @param  string  $replace The replacement value.
     */
    public function __construct(string $search, string $replace)
    {
        $this->search  = $search;
        $this->replace = $replace;
    }

    /**
     * @param  string  $search The value to search for.
     * @param  string  $replace The replacement value.
     */
    public static function make(string $search, string $replace): self
    {
        return new self($search, $replace);
    }

    protected function mutateString(string $value): string
    {
        if ($this->search === '') {
            return $value;
        }

        $position = strpos($value, $this->search);

        if ($position !== false) {
            return substr_replace($value, $this->replace, $position, strlen($this->search));
        }

        return $value;
    }
}
