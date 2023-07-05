<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\Serialization;

use ExeQue\Remix\Exceptions\SerializeException;
use ExeQue\Remix\Mutate\Mutator;
use Throwable;

/**
 * Deserialize input.
 *
 * @see unserialize()
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Deserialize extends Mutator
{
    private array $options;

    public function __construct(array $options = [])
    {
        $this->options = $options;
    }

    public static function make(array $options = []): self
    {
        return new self($options);
    }

    public function mutate(mixed $value): mixed
    {
        set_error_handler(static function (int $errno, string $errstr) {
            throw new SerializeException($errstr, $errno);
        });

        try {
            $data = unserialize($value, $this->options);
        } catch (Throwable $exception) {
            throw new SerializeException($exception->getMessage(), $exception->getCode(), $exception);
        } finally {
            restore_error_handler();
        }

        // TODO: Add check to throw an exception if a not-allowed class is deserialized anywhere in the output.

        return $data;
    }
}
