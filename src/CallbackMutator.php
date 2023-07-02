<?php

declare(strict_types=1);

namespace ExeQue\Mutators;

/**
 * Mutate a value using a callback.
 * The callback must accept a single argument and return a value.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class CallbackMutator extends Mutator
{
    private $callback;

    public function __construct(callable $callback)
    {
        $this->callback = $callback;
    }

    public static function make(callable $callback): self
    {
        return new static($callback);
    }

    public function mutate(mixed $value): mixed
    {
        return call_user_func($this->callback, $value);
    }
}
