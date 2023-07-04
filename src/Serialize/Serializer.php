<?php

declare(strict_types=1);

namespace ExeQue\Remix\Serialize;

abstract class Serializer implements SerializerInterface
{
    private $encoder;
    private $decoder;

    public function __construct(callable $encoder, callable $decoder)
    {
        $this->encoder = $encoder;
        $this->decoder = $decoder;
    }

    final public function encode(mixed $value): string
    {
        return ($this->encoder)($value);
    }

    final public function decode(mixed $value): mixed
    {
        return ($this->decoder)($value);
    }
}
