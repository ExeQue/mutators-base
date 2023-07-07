<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\Array;

/**
 * Filter an array using a callback. The callback receives both the value and the key of the array.
 *
 * @see array_filter()
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Filter extends ArrayMutator
{
    private $callback;

    /**
     * @param  callable|null  $callback The callback to use for filtering (optional).
     */
    public function __construct(callable $callback = null)
    {
        $this->callback = $callback;
    }

    /**
     * @param  callable|null  $callback The callback to use for filtering (optional).
     */
    public static function make(callable $callback = null): self
    {
        return new self($callback);
    }

    protected function mutateArray(array $array): array
    {
        return array_filter($array, $this->callback, ARRAY_FILTER_USE_BOTH);
    }
}
