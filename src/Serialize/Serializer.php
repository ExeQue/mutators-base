<?php

declare(strict_types=1);

namespace ExeQue\Remix\Serialize;

use ExeQue\Remix\Mutate\Serialization\Deserialize;
use ExeQue\Remix\Mutate\Serialization\Serialize;

/**
 * Serialize and deserialize input.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Serializer implements SerializerInterface
{
    private Serialize $encoder;
    private Deserialize $decoder;

    public function __construct(array $options = [])
    {
        $this->encoder = Serialize::make();
        $this->decoder = Deserialize::make($options);
    }

    public static function make(array $options = []): self
    {
        return new self($options);
    }

    final public function encode(mixed $value): string
    {
        return $this->encoder->mutate($value);
    }

    final public function decode(mixed $value): mixed
    {
        return $this->decoder->mutate($value);
    }
}
