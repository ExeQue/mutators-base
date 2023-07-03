<?php

declare(strict_types=1);

namespace ExeQue\Mutators\String;

/**
 * Append a string to the input.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Append extends StringMutator
{
    private string $append;

    public function __construct(string $append)
    {
        $this->append = $append;
    }

    public static function make(string $append): self
    {
        return new self($append);
    }

    protected function mutateString(string $value): string
    {
        return $value . $this->append;
    }
}
