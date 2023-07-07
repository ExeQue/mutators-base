<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\String;

use ExeQue\Remix\Assert;

/**
 * Masks a string with a single character based on a regular expression
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Mask extends StringMutator
{
    private string $pattern;
    private string $replacement;

    /**
     * @param  string  $pattern The regular expression to match.
     * @param  string  $replacement The replacement character (default: '*').
     */
    public function __construct(string $pattern, string $replacement = '*')
    {
        $this->validate($replacement, $pattern);

        $this->pattern     = $pattern;
        $this->replacement = $replacement;
    }

    /**
     * @param  string  $pattern The regular expression to match.
     * @param  string  $replacement The replacement character (default: '*').
     */
    public static function make(string $pattern, string $replacement = '*'): self
    {
        return new self($pattern, $replacement);
    }

    protected function mutateString(string $value): string
    {
        return preg_replace_callback($this->pattern, function ($matches) {
            return str_repeat($this->replacement, mb_strlen($matches[0]));
        }, $value);
    }

    private function validate(string $replacement, string $pattern): void
    {
        Assert::length($replacement, 1, 'Replacement must be a single character.');
    }
}
