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

    public function __construct(bool $strict = true)
    {
        $this->strict = $strict;
    }

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
