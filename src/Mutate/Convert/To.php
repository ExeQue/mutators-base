<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\Convert;

use Closure;
use ExeQue\Remix\Concerns\ResolvesStringInput;
use ExeQue\Remix\Exceptions\InvalidArgumentException;
use ExeQue\Remix\Mutate\Mutator;

/**
 * Convert the input to a given type,
 *
 * Supports the following types:
 * - `int`
 * - `float`
 * - `bool`
 * - `string`
 * - `array`
 * - `object`
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class To extends Mutator
{
    use ResolvesStringInput;

    private Closure $callback;

    /**
     * @param string $type The type to convert to.
     *
     * @throws InvalidArgumentException If the given type is not supported
     */
    public function __construct(string $type)
    {
        if ($this->isBool($type)) {
            $this->callback = fn ($value) => $this->castBool($value);
        }

        if ($this->isInt($type)) {
            $this->callback = fn ($value) => $this->castInt($value);
        }

        if ($this->isFloat($type)) {
            $this->callback = fn ($value) => $this->castFloat($value);
        }

        if ($this->isString($type)) {
            $this->callback = fn ($value) => $this->castString($value);
        }

        if ($this->isArray($type)) {
            $this->callback = fn ($value) => $this->castArray($value);
        }

        if ($this->isObject($type)) {
            $this->callback = fn ($value) => $this->castObject($value);
        }

        if (! isset($this->callback)) {
            throw new InvalidArgumentException('Invalid type given. Got: ' . $type);
        }
    }

    /**
     * @param string $type The type to convert to.
     *
     * @throws InvalidArgumentException If the given type is not supported
     */
    public static function make(string $type): self
    {
        return new self($type);
    }

    /**
     * Convert the input to a boolean.
     */
    public static function bool(): self
    {
        return self::make('bool');
    }

    /**
     * Convert the input to an integer.
     */
    public static function int(): self
    {
        return self::make('int');
    }

    /**
     * Convert the input to a float.
     */
    public static function float(): self
    {
        return self::make('float');
    }

    /**
     * Convert the input to a string.
     */
    public static function string(): self
    {
        return self::make('string');
    }

    /**
     * Convert the input to an array.
     */
    public static function array(): self
    {
        return self::make('array');
    }

    /**
     * Convert the input to an object.
     */
    public static function object(): self
    {
        return self::make('object');
    }

    public function mutate(mixed $value): mixed
    {
        return ($this->callback)($value);
    }

    private function isBool(string $type): bool
    {
        return $type === 'bool' || $type === 'boolean';
    }

    private function castBool($value): bool
    {
        return (bool)$value;
    }

    private function isInt(string $type): bool
    {
        return $type === 'int' || $type === 'integer';
    }

    private function castInt($value): int
    {
        if(is_object($value)) {
            throw new InvalidArgumentException('Cannot convert object to int');
        }

        return (int)$value;
    }

    private function isFloat(string $type): bool
    {
        return $type === 'float' || $type === 'double';
    }

    private function castFloat($value): float
    {
        if(is_object($value)) {
            throw new InvalidArgumentException('Cannot convert object to float');
        }

        return (float)$value;
    }

    private function isString(string $type): bool
    {
        return $type === 'string';
    }

    private function castString($value): string
    {
        if(is_bool($value)) {
            return (string)$value;
        }

        return $this->resolveStringInput($value);
    }

    private function isArray(string $type): bool
    {
        return $type === 'array';
    }

    private function castArray($value): array
    {
        if (is_array($value)) {
            return $value;
        }

        if (is_iterable($value)) {
            return iterator_to_array($value);
        }

        if (is_object($value)) {
            return [$value];
        }

        return (array)$value;
    }

    private function isObject(string $type): bool
    {
        return $type === 'object';
    }

    private function castObject($value): object
    {
        if(is_scalar($value)) {
            throw new InvalidArgumentException('Cannot convert scalar to object');
        }

        return (object)$value;
    }
}
