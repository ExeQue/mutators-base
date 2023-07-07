<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\Serialization;

use ExeQue\Remix\Concerns\Makes;
use ExeQue\Remix\Concerns\ResolvesStringInput;
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
    use ResolvesStringInput;

    public function mutate(mixed $value): string
    {
        $value = $this->resolveStringInput($value);

        return base64_encode($value);
    }
}
