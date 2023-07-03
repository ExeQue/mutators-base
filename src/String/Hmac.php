<?php

declare(strict_types=1);

namespace ExeQue\Mutators\String;

use ExeQue\Mutators\Assert;

/**
 * Generates a hash-based message authentication code (HMAC) using a secret key with the given algorithm.
 *
 * @see hash_hmac()
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Hmac extends StringMutator
{
    private string $algo;
    private string $key;
    private bool $rawOutput;

    public function __construct(string $algo, string $key, bool $rawOutput = false)
    {
        Assert::inArray($algo, hash_algos(), 'Invalid hash algorithm provided. Got: %s');

        $this->algo      = $algo;
        $this->key       = $key;
        $this->rawOutput = $rawOutput;
    }

    public static function make(string $algo, string $key, bool $rawOutput = false): self
    {
        return new self($algo, $key, $rawOutput);
    }

    protected function mutateString(string $value): string
    {
        return hash_hmac($this->algo, $value, $this->key, $this->rawOutput);
    }
}
