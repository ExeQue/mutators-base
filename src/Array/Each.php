<?php

declare(strict_types=1);

namespace ExeQue\Mutators\Array;

/**
 * Executes callback with each value in array. If callback returns explicit `false`, the loop is broken.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Each extends ArrayMutator
{
    /**
     * @var callable
     */
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
        foreach ($array as $key => $value) {
            if (($this->callback)($value, $key) === false) {
                break;
            }
        }

        return $array;
    }
}
