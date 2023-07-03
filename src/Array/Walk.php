<?php

declare(strict_types=1);

namespace ExeQue\Mutators\Array;

use ExeQue\Mutators\Assert;

/**
 * Apply a user function to every member of an array
 *
 * @see array_walk()
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Walk extends ArrayMutator
{
    private $callback;

    public function __construct(callable $callback)
    {
        $this->validate($callback);

        $this->callback = $callback;
    }

    public static function make(callable $callback): self
    {
        return new self($callback);
    }

    protected function mutateArray(array $array): array
    {
        array_walk($array, $this->callback);

        return $array;
    }

    private function validate(callable $callback): void
    {
        $reflector  = new \ReflectionFunction($callback);
        $parameters = $reflector->getParameters();

        Assert::countBetween($parameters, 1, 2, 'The callback must accept one or two parameters');
        Assert::true($parameters[0]->isPassedByReference(), 'The callback must accept the first parameter by reference');
    }
}
