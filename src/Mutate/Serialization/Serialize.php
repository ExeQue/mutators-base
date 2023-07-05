<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\Serialization;

use ExeQue\Remix\Concerns\Makes;
use ExeQue\Remix\Exceptions\SerializeException;
use ExeQue\Remix\Mutate\Mutator;
use Throwable;

/**
 * Serialize input
 *
 * @see serialize()
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Serialize extends Mutator
{
    use Makes;

    public function mutate(mixed $value): string
    {
        try {
            return serialize($value);
        } catch (Throwable $exception) {
            throw new SerializeException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }
}
