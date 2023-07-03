<?php

declare(strict_types=1);

namespace ExeQue\Mutators\String;

use ExeQue\Mutators\Assert;

/**
 * Generates a hash of the input string with the given algorithm.
 *
 * @see hash()
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Hash extends StringMutator
{
    private string $algo;
    private bool $rawOutput;

    public function __construct(string $algo, bool $rawOutput = false)
    {
        Assert::inArray($algo, hash_algos(), 'Invalid hash algorithm provided. Got: %s');

        $this->algo      = $algo;
        $this->rawOutput = $rawOutput;
    }

    public static function make(string $algo, bool $rawOutput = false): self
    {
        return new self($algo, $rawOutput);
    }

    protected function mutateString(string $value): string
    {
        return hash($this->algo, $value, $this->rawOutput);
    }
}
