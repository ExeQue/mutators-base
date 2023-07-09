<?php

declare(strict_types=1);

namespace ExeQue\Remix\Debugging;

use ExeQue\Remix\Mutate\Mutator;

/**
 * Allows you to dump the value inside a chain of mutators for inspection while developing. Kills the script afterwards.
 *
 * Uses the `dd` function if available, otherwise falls back to `var_dump` and `exit(1)`.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class DumpDie extends Mutator
{
    private array $args;

    /**
     * @param mixed ...$args Arguments to pass to the dump function _after_ the value.
     */
    public function __construct(mixed ...$args)
    {
        $this->args = $args;
    }

    /**
     * @param mixed ...$args Arguments to pass to the dump function _after_ the value.
     */
    public static function make(mixed ...$args): self
    {
        return new self(...$args);
    }

    public function mutate(mixed $value): mixed
    {
        $this->dump($value);

        return $value;
    }

    private function dump(mixed $value): void
    {
        if (function_exists('dd')) {
            dd($value, ...$this->args);
        }

        var_dump($value, ...$this->args);
        exit(1);
    }
}
