<?php

declare(strict_types=1);

namespace ExeQue\Mutators\Array;

use ExeQue\Mutators\Assert;
use ExeQue\Mutators\Mutator;

/**
 * Get element at the specified index. If the index does not exist, the default value is returned.
 *
 * If the default value is a callable, it will be invoked with the array and the index as arguments.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class At extends Mutator
{
    private string|int $index;
    private mixed $default;

    public function __construct(string|int $index, mixed $default = null)
    {
        $this->index   = $index;
        $this->default = $default;
    }

    public static function make(string|int $index, mixed $default = null): self
    {
        return new self($index, $default);
    }

    public function mutate(mixed $value): mixed
    {
        Assert::isIterable($value, static::class . ' expects an iterable value');

        if (! is_array($value)) {
            $value = iterator_to_array($value);
        }

        if (is_int($this->index) && array_is_list($value)) {
            return $this->resolveAsList($value);
        }

        return $value[$this->index] ?? $this->resolveDefault($value);
    }

    private function resolveAsList(mixed $value)
    {
        if ($this->index < 0) {
            $index = count($value) + $this->index;
        } else {
            $index = $this->index;
        }

        return $value[$index] ?? $this->resolveDefault($value);
    }

    private function resolveDefault(array $value): mixed
    {
        if (! is_string($this->default) && is_callable($this->default)) {
            return call_user_func($this->default, $value, $this->index);
        }

        return $this->default;
    }
}
