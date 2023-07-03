<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\Array;

use ExeQue\Remix\Assert;
use ExeQue\Remix\Mutate\Mutator;

/**
 * Retrieve the first element of an array. Optionally, a callback can be provided to filter the array.
 * If no element is found, null is returned.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class First extends Mutator
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
            return array_shift($value);
        }

        foreach ($value as $key => $item) {
            if (call_user_func($this->callback, $item, $key) === true) {
                return $item;
            }
        }

        return null;
    }
}
