<?php

declare(strict_types=1);

namespace ExeQue\Remix\Compare\String;

/**
 * Check if a string matches a regular expression pattern.
 *
 * @see preg_match()
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Matches extends StringComparator
{
    private string $pattern;

    /**
     * @param string $pattern The regular expression pattern to match against
     */
    public function __construct(string $pattern)
    {
        $this->pattern = $pattern;
    }

    /**
     * @param string $pattern The regular expression pattern to match against
     */
    public static function make(string $pattern): self
    {
        return new self($pattern);
    }

    protected function checkString(string $value): bool
    {
        return preg_match($this->pattern, $value) === 1;
    }
}
