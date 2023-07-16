<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\Array;

use ExeQue\Remix\Compare\Array\Accessible;
use ExeQue\Remix\Compare\Array\Has;
use ExeQue\Remix\Mutate\Mutator;

/**
 * Get value from array or object by key using dot-notation.
 *
 * If the key is an array, it will be treated as a path to the value.
 *
 * Ported and adapted from `illuminate/collections` helper `data_get`.
 *
 * @see https://github.com/laravel/framework/blob/10.x/src/Illuminate/Collections/helpers.php#L46
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Get extends Mutator
{
    private array|int|string $key;

    private mixed $default;

    /**
     * @param array|int|string $key The key to get
     * @param mixed|null $default The default value to return if the key does not exist. Can be callable (defaults to null).
     */
    public function __construct(array|int|string $key, mixed $default = null)
    {
        $this->key     = $key;
        $this->default = $default;
    }

    /**
     * @param array|int|string $key The key to get
     * @param mixed|null $default The default value to return if the key does not exist. Can be callable (defaults to null).
     */
    public static function make(array|int|string $key, mixed $default = null): self
    {
        return new self($key, $default);
    }

    public function mutate(mixed $value): mixed
    {
        return $this->get($value, $this->key);
    }

    private function get($target, $key)
    {
        $key = is_array($key) ? $key : explode('.', (string)$key);

        foreach ($key as $i => $segment) {
            unset($key[$i]);

            if (is_null($segment)) {
                return $target;
            }

            if ($segment === '*') {
                if (! is_iterable($target)) {
                    return $this->resolveDefault();
                }

                $result = [];

                foreach ($target as $item) {
                    $result[] = $this->get($item, $key);
                }

                return in_array('*', $key, true) ? Collapse::make()->mutate($result) : $result;
            }

            if (Accessible::make()->check($target) && Has::make($segment)->check($target)) {
                $target = $target[$segment];
            } elseif (is_object($target) && isset($target->{$segment})) {
                $target = $target->{$segment};
            } else {
                return $this->resolveDefault();
            }
        }

        return $target;
    }

    private function resolveDefault()
    {
        if (!is_string($this->default) && is_callable($this->default)) {
            return ($this->default)();
        }

        return $this->default;
    }
}
