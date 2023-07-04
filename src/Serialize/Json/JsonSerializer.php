<?php

declare(strict_types=1);

namespace ExeQue\Remix\Serialize\Json;

use ExeQue\Remix\Mutate\Serialization\JsonDecode;
use ExeQue\Remix\Mutate\Serialization\JsonEncode;
use ExeQue\Remix\Serialize\Serializer;

/**
 * Encodes and decodes data to and from JSON. Decodes to associative arrays by default.
 *
 * Throws a JsonDecodeException if decoding or encoding fails.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class JsonSerializer extends Serializer
{
    public function __construct(JsonEncode $encoder = null, JsonDecode $decoder = null)
    {
        parent::__construct($encoder ?? JsonEncode::make(), $decoder ?? JsonDecode::make());
    }

    public static function make(JsonEncode $encoder = null, JsonDecode $decoder = null): self
    {
        return new self($encoder, $decoder);
    }
}
