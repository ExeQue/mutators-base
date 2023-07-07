<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\String;

use ExeQue\Remix\Concerns\Definitions\UsesEncoding;

/**
 * Converts the first character of each word in a string to uppercase.
 * Ignores existing uppercase characters.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Ucwords extends StringMutator
{
    use UsesEncoding;

    /**
     * @param  string|null  $encoding The encoding to use (optional).
     */
    public function __construct(string $encoding = null)
    {
        $this->setEncoding($encoding);
    }

    /**
     * @param  string|null  $encoding The encoding to use (optional).
     */
    public static function make(string $encoding = null): self
    {
        return new self($encoding);
    }

    protected function mutateString(string $value): string
    {
        return mb_ucwords($value, $this->getEncoding($value));
    }
}
