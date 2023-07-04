<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\Serialization;

use ExeQue\Remix\Exceptions\JsonException;
use ExeQue\Remix\Mutate\Mutator;
use JsonException as VanillaJsonException;

/**
 * Decode a JSON string to an associative array or object. Associative arrays are the default.
 *
 * Throws a JsonException if the JSON cannot be decoded.
 *
 * @see json_decode()
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class JsonDecode extends Mutator
{
    private ?bool $associative;
    private int $flags;
    private int $depth;

    public function __construct(bool $associative = true, int $depth = 512, int $flags = 0)
    {
        $this->associative = $associative;
        $this->flags       = $flags | JSON_THROW_ON_ERROR;
        $this->depth       = $depth;
    }

    public static function make(bool $associative = true, int $depth = 512, int $flags = 0): self
    {
        return new self($associative, $depth, $flags);
    }

    public static function assoc(int $depth = 512, int $flags = 0): self
    {
        return new self(true, $depth, $flags);
    }

    public static function object(int $depth = 512, int $flags = 0): self
    {
        return new self(false, $depth, $flags);
    }

    public function mutate(mixed $value): mixed
    {
        try {
            return json_decode($value, $this->associative, $this->depth, $this->flags);
        } catch (VanillaJsonException $exception) {
            throw new JsonException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }
}
