<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\Serialization;

use ExeQue\Remix\Exceptions\JsonException;
use ExeQue\Remix\Mutate\Mutator;
use JsonException as VanillaJsonException;

/**
 * Encode a value into a JSON string.
 *
 * Throws an exception if the value cannot be encoded.
 *
 * @see json_encode()
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class JsonEncode extends Mutator
{
    private int $flags;
    private int $depth;

    public function __construct(int $flags = 0, int $depth = 512)
    {
        $this->flags = $flags | JSON_THROW_ON_ERROR;
        $this->depth = $depth;
    }

    public static function make(int $flags = 0, int $depth = 512): self
    {
        return new self($flags, $depth);
    }

    public static function pretty(int $flags = 0, int $depth = 512): self
    {
        return new self($flags | JSON_PRETTY_PRINT, $depth);
    }

    public function mutate(mixed $value): string
    {
        try {
            return json_encode($value, $this->flags, $this->depth);
        } catch (VanillaJsonException $exception) {
            throw new JsonException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }
}
