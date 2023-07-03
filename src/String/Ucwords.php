<?php

declare(strict_types=1);

namespace ExeQue\Mutators\String;

use ExeQue\Mutators\Concerns\Definitions\UsesEncoding;

/**
 * Converts the first character of each word in a string to uppercase.
 * Ignores existing uppercase characters.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Ucwords extends StringMutator
{
    use UsesEncoding;

    public function __construct(string $encoding = null)
    {
        $this->setEncoding($encoding);
    }

    public static function make(string $encoding = null): self
    {
        return new self($encoding);
    }

    protected function mutateString(string $value): string
    {
        return mb_ucwords($value, $this->getEncoding($value));
    }
}
