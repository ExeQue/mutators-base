<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\String;

use ExeQue\Remix\Concerns\Definitions\UsesEncoding;

/**
 * Converts the first character of a string to uppercase.
 * Ignores existing uppercase characters.
 *
 * @see mb_ucfirst()
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Ucfirst extends StringMutator
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
        return mb_ucfirst($value, $this->getEncoding($value));
    }
}
