<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\Array;

/**
 * Removes specified keys from an array.
 *
 * @see array_diff_key()
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Except extends ArrayMutator
{
    private array $keys;

    public function __construct(array|string $keys)
    {
        $this->keys = (array)$keys;
    }

    public static function make(array|string $keys): self
    {
        return new self($keys);
    }

    protected function mutateArray(array $array): array
    {
        return array_diff_key($array, array_flip($this->keys));
    }
}
