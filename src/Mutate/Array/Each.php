<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\Array;

/**
 * Executes callback with each value in array. If callback returns explicit `false`, the loop is broken.
 *
 * Does _NOT_ mutate the input array - It only iterates over it.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Each extends ArrayMutator
{
    /**
     * @var callable
     */
    private $callback;

    /**
     * @param  callable  $callback The callback to execute
     */
    public function __construct(callable $callback)
    {
        $this->callback = $callback;
    }

    /**
     * @param  callable  $callback The callback to execute
     */
    public static function make(callable $callback): self
    {
        return new self($callback);
    }

    protected function mutateArray(array $array): array
    {
        foreach ($array as $key => $value) {
            if (($this->callback)($value, $key) === false) {
                break;
            }
        }

        return $array;
    }
}
