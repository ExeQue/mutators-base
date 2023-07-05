<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\Serialization;

use ExeQue\Remix\Assert;
use ExeQue\Remix\Concerns\Makes;
use ExeQue\Remix\Mutate\Mutator;

/**
 * Encode a string using to base64.
 *
 * @see base64_encode()
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Base64Encode extends Mutator
{
    use Makes;
    public function mutate(mixed $value): string
    {
        Assert::stringable($value, 'Value must be a stringable value');

        return base64_encode((string)$value);
    }
}
