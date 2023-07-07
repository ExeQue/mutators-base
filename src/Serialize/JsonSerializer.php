<?php

declare(strict_types=1);

namespace ExeQue\Remix\Serialize;

use ExeQue\Remix\Mutate\Serialization\JsonDecode;
use ExeQue\Remix\Mutate\Serialization\JsonEncode;

/**
 * Encodes and decodes data to and from JSON. Decodes to associative arrays by default.
 *
 * Throws a JsonDecodeException if decoding or encoding fails.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class JsonSerializer implements SerializerInterface
{
    private JsonEncode $encoder;
    private JsonDecode $decoder;

    /**
     * @param  JsonEncode|null  $encoder The encoder to use (optional, defaults to a new JsonEncode instance).
     * @param  JsonDecode|null  $decoder The decoder to use (optional, defaults to a new JsonDecode instance).
     */
    public function __construct(JsonEncode $encoder = null, JsonDecode $decoder = null)
    {
        $this->encoder = $encoder ?? JsonEncode::make();
        $this->decoder = $decoder ?? JsonDecode::make();
    }

    /**
     * @param  JsonEncode|null  $encoder The encoder to use (optional, defaults to a new JsonEncode instance).
     * @param  JsonDecode|null  $decoder The decoder to use (optional, defaults to a new JsonDecode instance).
     */
    public static function make(JsonEncode $encoder = null, JsonDecode $decoder = null): self
    {
        return new self($encoder, $decoder);
    }

    public function encode(mixed $value): string
    {
        return $this->encoder->mutate($value);
    }

    public function decode(mixed $value): mixed
    {
        return $this->decoder->mutate($value);
    }
}
