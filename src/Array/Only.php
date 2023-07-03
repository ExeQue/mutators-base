<?php

declare(strict_types=1);

namespace ExeQue\Mutators\Array;

/**
 * Retrieve only the keys specified.
 *
 * @see array_intersect_key()
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Only extends ArrayMutator
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
        return array_intersect_key($array, array_flip($this->keys));
    }
}
