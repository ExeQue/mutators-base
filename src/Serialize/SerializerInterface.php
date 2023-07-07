<?php

declare(strict_types=1);

namespace ExeQue\Remix\Serialize;

interface SerializerInterface
{
    /**
     * Serialize the value.
     *
     * @param mixed $value The value to encode.
     */
    public function encode(mixed $value): mixed;

    /**
     * Deserialize the value.
     *
     * @param mixed $value The value to decode.
     */
    public function decode(mixed $value): mixed;
}
