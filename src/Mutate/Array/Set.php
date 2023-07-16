<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\Array;

use ExeQue\Remix\Compare\Array\Accessible;
use ExeQue\Remix\Compare\Array\Has;
use ExeQue\Remix\Mutate\Mutator;

/**
 * Set a value in an array or object by key using dot notation.
 *
 * If the key is an array, it will be treated as a path to the value.
 *
 * Ported and adapted from `illuminate/collections` helper `data_set`.
 *
 * @see https://github.com/laravel/framework/blob/10.x/src/Illuminate/Collections/helpers.php#L100
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Set extends Mutator
{
    private string|int|array $key;
    private mixed $value;
    private bool $overwrite;

    /**
     * @param array|int|string $key The key to set
     * @param mixed $value The value to set
     * @param bool $overwrite Whether to overwrite existing values (default: true)
     */
    public function __construct(array|int|string $key, mixed $value, bool $overwrite = true)
    {
        $this->key       = $key;
        $this->value     = $value;
        $this->overwrite = $overwrite;
    }

    /**
     * @param array|int|string $key The key to set
     * @param mixed $value The value to set
     * @param bool $overwrite Whether to overwrite existing values (default: true)
     */
    public static function make(array|int|string $key, mixed $value, bool $overwrite = true): self
    {
        return new self($key, $value, $overwrite);
    }

    public function mutate(mixed $value): mixed
    {
        return $this->set($value, $this->key, $this->value, $this->overwrite);
    }

    private function set(&$target, $key, $value, $overwrite): mixed
    {
        $segments = is_array($key) ? $key : explode('.', (string)$key);

        if (($segment = array_shift($segments)) === '*') {
            if (! Accessible::make()->check($target)) {
                $target = [];
            }

            if ($segments) {
                foreach ($target as &$inner) {
                    $this->set($inner, $segments, $value, $overwrite);
                }
            } elseif ($overwrite) {
                foreach ($target as &$inner) {
                    $inner = $value;
                }
            }
        } elseif (Accessible::make()->check($target)) {
            if ($segments) {
                if (! Has::make($segment)->check($target)) {
                    $target[$segment] = [];
                }

                $this->set($target[$segment], $segments, $value, $overwrite);
            } elseif ($overwrite || ! Has::make($segment)->check($target)) {
                $target[$segment] = $value;
            }
        } elseif (is_object($target)) {
            if ($segments) {
                if (! isset($target->{$segment})) {
                    $target->{$segment} = [];
                }

                $this->set($target->{$segment}, $segments, $value, $overwrite);
            } elseif ($overwrite || ! isset($target->{$segment})) {
                $target->{$segment} = $value;
            }
        } else {
            $target = [];

            if ($segments) {
                $this->set($target[$segment], $segments, $value, $overwrite);
            } elseif ($overwrite) {
                $target[$segment] = $value;
            }
        }

        return $target;
    }
}
