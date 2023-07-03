<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\Array;

use ExeQue\Remix\Assert;
use ExeQue\Remix\Mutate\Mutator;

/**
 * Returns the last element of an array.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Last extends Mutator
{
    private $callback;

    public function __construct(callable $callback = null)
    {
        $this->callback = $callback;
    }

    public static function make(callable $callback = null): self
    {
        return new self($callback);
    }

    public function mutate(mixed $value): mixed
    {
        Assert::isIterable($value, static::class . ' expects an iterable value');

        if (! is_array($value)) {
            $value = iterator_to_array($value);
        }

        if ($this->callback === null) {
            return array_pop($value);
        }

        for (end($value); ($key = key($value)) !== null; prev($value)) {
            $current = current($value);

            if (call_user_func($this->callback, $current, $key) === true) {
                return $current;
            }
        }

        return null;
    }
}
