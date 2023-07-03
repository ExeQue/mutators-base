<?php

declare(strict_types=1);

namespace ExeQue\Mutators\String;

/**
 * Check if a string contains the search string, with support for case insensitivity.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Contains extends StringComparator
{
    private string $search;
    private bool $caseSensitive;

    public function __construct(string $search, bool $caseSensitive = true)
    {
        $this->search        = $search;
        $this->caseSensitive = $caseSensitive;
    }

    public static function make(string $search, bool $caseSensitive = true): self
    {
        return new self($search, $caseSensitive);
    }

    protected function compareString(string $value): bool
    {
        if ($this->caseSensitive) {
            return str_contains($value, $this->search);
        }

        return str_contains(mb_strtolower($value), mb_strtolower($this->search));
    }
}
