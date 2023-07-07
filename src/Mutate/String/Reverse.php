<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\String;

use ExeQue\Remix\Concerns\Definitions\UsesEncoding;

/**
 * Reverses the string
 *
 * @see mb_strrev()
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Reverse extends StringMutator
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
        return mb_strrev($value, $this->getEncoding($value));
    }
}
