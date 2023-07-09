<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\Array;

use ExeQue\Remix\Assert;
use ReflectionFunction;

/**
 * Apply a user function recursively to every member of an array
 *
 * @see array_walk_recursive()
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class WalkRecursive extends ArrayMutator
{
    private $callback;

    /**
     * @param callable $callback The callback to use for mutation - Must accept the first parameter by reference
     */
    public function __construct(callable $callback)
    {
        $this->validate($callback);

        $this->callback = $callback;
    }

    /**
     * @param callable $callback The callback to use for mutation - Must accept the first parameter by reference
     */
    public static function make(callable $callback): self
    {
        return new self($callback);
    }

    protected function mutateArray(array $array): array
    {
        array_walk_recursive($array, $this->callback);

        return $array;
    }

    private function validate(callable $callback): void
    {
        $reflector  = new ReflectionFunction($callback);
        $parameters = $reflector->getParameters();

        Assert::countBetween($parameters, 1, 2, 'The callback must accept one or two parameters');
        Assert::true($parameters[0]->isPassedByReference(), 'The callback must accept the first parameter by reference');
    }
}
