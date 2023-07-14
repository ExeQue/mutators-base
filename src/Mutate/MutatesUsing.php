<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate;

use ExeQue\Remix\Assert;

/**
 * Mutate a value using a callback.
 *
 * The callback can accept a single argument and return a value
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class MutatesUsing extends Mutator
{
    private $callback;

    /**
     * @param callable $callback The callback to use for mutation.
     */
    public function __construct(mixed $callback)
    {
        if(is_string($callback)) {
            Assert::report($callback, 'Callback must be callable. Got %s', $callback);
        }

        Assert::isCallable($callback, 'Callback must be callable. Got %s');

        $this->callback = $callback;
    }

    /**
     * @param callable $callback The callback to use for mutation.
     */
    public static function make(mixed $callback): self
    {
        return new self($callback);
    }

    public function mutate(mixed $value): mixed
    {
        return ($this->callback)($value);
    }
}
