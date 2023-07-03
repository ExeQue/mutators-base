<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\String;

/**
 * Retrieves the part of a string before a given substring.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Before extends StringMutator
{
    private string $search;
    private bool $last;

    public function __construct(string $search, bool $last = false)
    {
        $this->search = $search;
        $this->last   = $last;
    }

    public static function make(string $search, bool $last = false): self
    {
        return new self($search, $last);
    }

    protected function mutateString(string $value): string
    {
        if (! str_contains($value, $this->search)) {
            return $value;
        }

        if ($this->last) {
            return mb_substr($value, 0, mb_strrpos($value, $this->search));
        }

        return mb_substr($value, 0, mb_strpos($value, $this->search));
    }
}
