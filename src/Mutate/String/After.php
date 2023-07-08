<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\String;

/**
 * Retrieves the remainder of a string after a given substring.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class After extends StringMutator
{
    private string $search;
    private bool $last;

    /**
     * @param  string  $search The substring to search for.
     * @param  bool  $last Whether to search for the last occurrence of the substring (default: false).
     */
    public function __construct(string $search, bool $last = false)
    {
        $this->search = $search;
        $this->last   = $last;
    }

    /**
     * @param  string  $search The substring to search for.
     * @param  bool  $last Whether to search for the last occurrence of the substring (default: false).
     */
    public static function make(string $search, bool $last = false): self
    {
        return new self($search, $last);
    }

    /**
     * Retrieves the part of a string after the first occurrence of a given substring.
     *
     * @param  string  $search The substring to search for.
     */
    public static function first(string $search): self
    {
        return new self($search, false);
    }

    /**
     * Retrieves the part of a string after the last occurrence of a given substring.
     *
     * @param  string  $search The substring to search for.
     */
    public static function last(string $search): self
    {
        return new self($search, true);
    }

    protected function mutateString(string $value): string
    {
        if (! str_contains($value, $this->search)) {
            return $value;
        }

        if ($this->last) {
            return mb_substr($value, mb_strrpos($value, $this->search) + mb_strlen($this->search));
        }

        return mb_substr($value, mb_strpos($value, $this->search) + mb_strlen($this->search));
    }
}
