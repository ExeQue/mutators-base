<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\String;

use ExeQue\Remix\Assert;

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

    /**
     * @param  string  $algo The algorithm to use.
     * @param  string  $key The secret key.
     * @param  bool  $rawOutput Whether to output raw binary data (default: false).
     */
    public function __construct(string $algo, string $key, bool $rawOutput = false)
    {
        Assert::inArray($algo, hash_algos(), 'Invalid hash algorithm provided. Got: %s');

        $this->algo      = $algo;
        $this->key       = $key;
        $this->rawOutput = $rawOutput;
    }

    /**
     * @param  string  $algo The algorithm to use.
     * @param  string  $key The secret key.
     * @param  bool  $rawOutput Whether to output raw binary data (default: false).
     */
    public static function make(string $algo, string $key, bool $rawOutput = false): self
    {
        return new self($algo, $key, $rawOutput);
    }

    protected function mutateString(string $value): string
    {
        return hash_hmac($this->algo, $value, $this->key, $this->rawOutput);
    }
}
