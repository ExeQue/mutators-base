<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\String;

/**
 * Truncate a string to a given length. Appends the provided ellipsis to the end of the string if it is truncated.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Truncate extends StringMutator
{
    private int $length;
    private string $ellipsis;

    public function __construct(int $length, string $ellipsis = '...')
    {
        $this->length   = $length;
        $this->ellipsis = $ellipsis;
    }

    public static function make(int $length, string $ellipsis = '...'): self
    {
        return new self($length, $ellipsis);
    }

    protected function mutateString(string $value): string
    {
        if (mb_strlen($value) <= $this->length) {
            return $value;
        }

        return mb_substr($value, 0, $this->length) . $this->ellipsis;
    }
}
