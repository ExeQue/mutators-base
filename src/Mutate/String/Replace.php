<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\String;

/**
 * Replace all occurrences of the search string with the replacement string.
 *
 * @see str_replace()
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Replace extends StringMutator
{
    private string|array $search;
    private string|array $replace;
    private bool $caseSensitive;

    /**
     * @param array|string $search The value(s) to search for.
     * @param array|string $replace The replacement value(s).
     * @param bool $caseSensitive Whether to perform a case-sensitive search (default: true).
     */
    public function __construct(array|string $search, array|string $replace, bool $caseSensitive = true)
    {
        $this->search        = $search;
        $this->replace       = $replace;
        $this->caseSensitive = $caseSensitive;
    }

    /**
     * @param array|string $search The value(s) to search for.
     * @param array|string $replace The replacement value(s).
     * @param bool $caseSensitive Whether to perform a case-sensitive search (default: true).
     */
    public static function make(array|string $search, array|string $replace, bool $caseSensitive = true): self
    {
        return new self($search, $replace, $caseSensitive);
    }

    protected function mutateString(string $value): string
    {
        if (! $this->caseSensitive) {
            return str_ireplace($this->search, $this->replace, $value);
        }

        return str_replace($this->search, $this->replace, $value);
    }
}
