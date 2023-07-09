<?php

declare(strict_types=1);

namespace ExeQue\Remix\Compare\String;

use ExeQue\Remix\Mutate\String\Casing;

/**
 * Check if a string contains any or all of the search strings, with support for case insensitivity.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Contains extends StringComparator
{
    private array|string $search;
    private bool $caseSensitive;
    private bool $all;

    /**
     * @param  array|string  $search The string(s) to search for
     * @param  bool  $caseSensitive Whether to perform a case-sensitive search (default: true)
     * @param  bool  $all Whether to check if all the search strings are contained in the subject (default: true)
     */
    public function __construct(array|string $search, bool $caseSensitive = true, bool $all = true)
    {
        if (is_string($search)) {
            $search = [$search];
        }

        $this->search        = $search;
        $this->caseSensitive = $caseSensitive;
        $this->all           = $all;
    }

    /**
     * @param  array|string  $search The string(s) to search for
     * @param  bool  $caseSensitive Whether to perform a case-sensitive search (default: true)
     * @param  bool  $all Whether to check if all the search strings are contained in the subject (default: true)
     */
    public static function make(array|string $search, bool $caseSensitive = true, bool $all = true): self
    {
        return new self($search, $caseSensitive, $all);
    }

    public static function all(array|string $search, bool $caseSensitive = true): self
    {
        return new self($search, $caseSensitive, true);
    }

    public static function any(array|string $search, bool $caseSensitive = true): self
    {
        return new self($search, $caseSensitive, false);
    }

    protected function checkString(string $value): bool
    {
        $caser = $this->caseSensitive ? static fn ($v) => $v : Casing::lower();

        $searchStrings = array_map($caser, $this->search);
        $subject       = $caser($value);

        if ($this->all) {
            foreach ($searchStrings as $search) {
                if (! str_contains($subject, $search)) {
                    return false;
                }
            }

            return true;
        }

        foreach ($searchStrings as $search) {
            if (str_contains($subject, $search)) {
                return true;
            }
        }

        return false;
    }
}
