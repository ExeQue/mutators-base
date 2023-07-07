<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\String;

use ExeQue\Remix\Assert;

/**
 * Generates a hash of the input string with the given algorithm.
 *
 * @see hash()
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Hash extends StringMutator
{
    private string $algorithm;
    private bool $rawOutput;

    /**
     * @param  string  $algorithm The algorithm to use.
     * @param  bool  $rawOutput Whether to output raw binary data (default: false).
     */
    public function __construct(string $algorithm, bool $rawOutput = false)
    {
        Assert::inArray($algorithm, hash_algos(), 'Invalid hash algorithm provided. Got: %s');

        $this->algorithm = $algorithm;
        $this->rawOutput = $rawOutput;
    }

    /**
     * @param  string  $algorithm The algorithm to use.
     * @param  bool  $rawOutput Whether to output raw binary data (default: false).
     */
    public static function make(string $algorithm, bool $rawOutput = false): self
    {
        return new self($algorithm, $rawOutput);
    }

    /**
     * @param  bool  $rawOutput Whether to output raw binary data (default: false).
     */
    public static function crc32(bool $rawOutput = false): self
    {
        return self::make('crc32', $rawOutput);
    }

    /**
     * @param  bool  $rawOutput Whether to output raw binary data (default: false).
     */
    public static function md5(bool $rawOutput = false): self
    {
        return self::make('md5', $rawOutput);
    }

    /**
     * @param  bool  $rawOutput Whether to output raw binary data (default: false).
     */
    public static function sha1(bool $rawOutput = false): self
    {
        return self::make('sha1', $rawOutput);
    }

    /**
     * @param  bool  $rawOutput Whether to output raw binary data (default: false).
     */
    public static function sha256(bool $rawOutput = false): self
    {
        return self::make('sha256', $rawOutput);
    }

    /**
     * @param  bool  $rawOutput Whether to output raw binary data (default: false).
     */
    public static function sha512(bool $rawOutput = false): self
    {
        return self::make('sha512', $rawOutput);
    }

    protected function mutateString(string $value): string
    {
        return hash($this->algorithm, $value, $this->rawOutput);
    }
}
