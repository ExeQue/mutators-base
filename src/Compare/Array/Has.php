<?php

declare(strict_types=1);

namespace ExeQue\Remix\Compare\Array;

use ArrayAccess;
use ExeQue\Remix\Assert;
use ExeQue\Remix\Compare\Comparator;

/**
 * Check if a given key exists using dot-notation.
 *
 * Ported and adapted from `illuminate/collections` helper `Arr::has`.
 *
 * @see https://github.com/laravel/framework/blob/10.x/src/Illuminate/Collections/Arr.php#L344
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Has extends Comparator
{
    private string|int $key;

    /**
     * @param int|string $key Key to search for.
     */
    public function __construct(int|string $key)
    {
        $this->key = $key;
    }

    /**
     * @param int|string $key Key to search for.
     */
    public static function make(int|string $key): self
    {
        return new self($key);
    }

    public function check(mixed $value): bool
    {
        if(!is_array($value) && !is_object($value)) {
            Assert::report('Value must be an array or object. Got: %s', $value);
        }

        $keys = (array) $this->key;

        if (! $value || $keys === []) {
            return false;
        }

        foreach ($keys as $key) {
            $subKeyArray = $value;

            if ($this->exists($value, $key)) {
                continue;
            }

            foreach (explode('.', (string)$key) as $segment) {
                if ($this->exists($subKeyArray, $segment) && Accessible::make()->check($subKeyArray)) {
                    $subKeyArray = $subKeyArray[$segment];
                } else {
                    return false;
                }
            }
        }

        return true;
    }

    private function exists($array, $key): bool
    {
        if ($array instanceof ArrayAccess) {
            return $array->offsetExists($key);
        }

        if (! is_int($key)) {
            $key = (string) $key;
        }

        if(is_object($array)) {
            return property_exists($array, $key);
        }

        return array_key_exists($key, $array);
    }
}
