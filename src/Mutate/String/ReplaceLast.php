<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\String;

/**
 * Replaces the last occurrence of the search string with the replacement string.
 *
 * Ported from `illuminate/support` to prevent package collisions.
 *
 * @see https://laravel.com/api/10.x/Illuminate/Support/Str.html#method_replaceLast
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class ReplaceLast extends StringMutator
{
    private string $search;
    private string $replace;
    private bool $caseSensitive;

    /**
     * @param string $search The value to search for.
     * @param string $replace The replacement value.
     * @param bool $caseSensitive Whether to perform a case-sensitive search (default: true).
     */
    public function __construct(string $search, string $replace, bool $caseSensitive = true)
    {
        $this->search        = $search;
        $this->replace       = $replace;
        $this->caseSensitive = $caseSensitive;
    }

    /**
     * @param string $search The value to search for.
     * @param string $replace The replacement value.
     * @param bool $caseSensitive Whether to perform a case-sensitive search (default: true).
     */
    public static function make(string $search, string $replace, bool $caseSensitive = true): self
    {
        return new self($search, $replace, $caseSensitive);
    }

    protected function mutateString(string $value): string
    {
        if ($this->search === '') {
            return $value;
        }

        if ($this->caseSensitive) {
            $position = mb_strrpos($value, $this->search);
        } else {
            $position = mb_strripos($value, $this->search);
        }

        if ($position !== false) {
            return substr_replace($value, $this->replace, $position, strlen($this->search));
        }

        return $value;
    }
}
