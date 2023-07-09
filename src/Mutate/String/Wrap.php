<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\String;

/**
 * Wraps a string in a prefix and suffix. Uses the same prefix and suffix if only one is provided.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Wrap extends StringMutator
{
    private string $before;
    private string $after;

    /**
     * @param string $before The prefix to prepend to the string.
     * @param string|null $after The suffix to append to the string (optional, defaults to the prefix).
     */
    public function __construct(string $before, string $after = null)
    {
        $this->before = $before;
        $this->after  = $after ?? $before;
    }

    /**
     * @param string $before The prefix to prepend to the string.
     * @param string|null $after The suffix to append to the string (optional, defaults to the prefix).
     */
    public static function make(string $before, string $after = null): self
    {
        return new self($before, $after);
    }

    protected function mutateString(string $value): string
    {
        return $this->before . $value . $this->after;
    }
}
