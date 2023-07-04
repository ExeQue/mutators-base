<?php

declare(strict_types=1);

namespace ExeQue\Remix\Compare\String;

use ExeQue\Remix\Assert;

/**
 * Check if a string contains any of search strings, with support for case insensitivity.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class ContainsAny extends StringComparator
{
    private array $search;
    private bool $caseSensitive;

    public function __construct(array $search, bool $caseSensitive = true)
    {
        Assert::allStringable($search);

        $this->search        = $search;
        $this->caseSensitive = $caseSensitive;
    }

    public static function make(array $search, bool $caseSensitive = true): self
    {
        return new self($search, $caseSensitive);
    }

    protected function compareString(string $value): bool
    {
        foreach ($this->search as $search) {
            if ($this->caseSensitive) {
                if (str_contains($value, $search)) {
                    return true;
                }
            } elseif (str_contains(mb_strtolower($value), mb_strtolower($search))) {
                return true;
            }
        }

        return false;
    }
}