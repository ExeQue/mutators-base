<?php

declare(strict_types=1);

namespace ExeQue\Remix\Serialize;

use ExeQue\Remix\Mutate\Serialization\Base64Decode;
use ExeQue\Remix\Mutate\Serialization\Base64Encode;

/**
 * Encodes and decodes data to and from base64.
 *
 * Throws a Base64Exception when decoding an invalid base64 string while strict is true.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Base64Serializer implements SerializerInterface
{
    private Base64Encode $encoder;
    private Base64Decode $decoder;

    /**
     * @param  bool  $strict Whether to throw an exception when decoding an invalid base64 string (default: true).
     */
    public function __construct(bool $strict = true)
    {
        $this->encoder = Base64Encode::make();
        $this->decoder = Base64Decode::make($strict);
    }

    /**
     * @param  bool  $strict Whether to throw an exception when decoding an invalid base64 string (default: true).
     */
    public static function make(bool $strict = true): self
    {
        return new self($strict);
    }

    public function encode(mixed $value): string
    {
        return $this->encoder->mutate($value);
    }

    public function decode(mixed $value): string
    {
        return $this->decoder->mutate($value);
    }
}
