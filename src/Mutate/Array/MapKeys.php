<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\Array;

/**
 * Applies the callback to the keys of the given array
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class MapKeys extends ArrayMutator
{
    private $callback;

    public function __construct(callable $callback)
    {
        $this->callback = $callback;
    }

    public static function make(callable $callback): self
    {
        return new self($callback);
    }

    protected function mutateArray(array $array): array
    {
        return array_combine(
            array_map($this->callback, array_keys($array)),
            array_values($array)
        );
    }
}
