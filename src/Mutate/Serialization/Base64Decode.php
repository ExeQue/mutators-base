<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\Serialization;

use ExeQue\Remix\Assert;
use ExeQue\Remix\Exceptions\InvalidArgumentException;
use ExeQue\Remix\Mutate\Mutator;
use ExeQue\Remix\Mutate\String\Truncate;

/**
 * Decode a base64 encoded string.
 *
 * @see base64_decode()
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Base64Decode extends Mutator
{
    private bool $strict;

    /**
     * @param  bool  $strict If true, the function will return false if the input contains character from outside the base64 alphabet or if the input contains character sequences that are not valid base64 encodings (e.g. a base64 encoded string from a different encoding or truncated). (default: true)
     */
    public function __construct(bool $strict = true)
    {
        $this->strict = $strict;
    }

    /**
     * @param  bool  $strict If true, the function will return false if the input contains character from outside the base64 alphabet or if the input contains character sequences that are not valid base64 encodings (e.g. a base64 encoded string from a different encoding or truncated). (default: true)
     */
    public static function make(bool $strict = true): self
    {
        return new self($strict);
    }

    public function mutate(mixed $value): string
    {
        Assert::string($value, 'Value must be a string. Got: %s');

        if (($data = base64_decode((string)$value, $this->strict)) !== false) {
            return $data;
        }

        $value = Truncate::make(28)->mutate((string)$value);

        throw new InvalidArgumentException('Invalid base64 encoded string: ' . $value);
    }
}
