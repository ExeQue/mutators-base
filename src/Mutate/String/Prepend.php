<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\String;

/**
 * Prepend a string to the value.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Prepend extends StringMutator
{
    private string $prepend;

    public function __construct(string $prepend)
    {
        $this->prepend = $prepend;
    }

    public static function make(string $prepend): self
    {
        return new self($prepend);
    }

    protected function mutateString(string $value): string
    {
        return $this->prepend . $value;
    }
}
