<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate;

abstract class Mutator implements MutatorInterface
{
    /**
     * Forwards to the mutate method.
     *
     * @author Morten Harders <mmh@harders-it.dk>
     */
    final public function __invoke(mixed $value): mixed
    {
        return $this->mutate($value);
    }
}
