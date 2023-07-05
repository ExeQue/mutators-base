<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\Convert;

use ExeQue\Remix\Concerns\Makes;
use ExeQue\Remix\Concerns\Sanitization\SanitizesHexStrings;
use ExeQue\Remix\Exceptions\InvalidArgumentException;
use ExeQue\Remix\Mutate\String\StringMutator;
use ExeQue\Remix\Mutate\String\Truncate;
use ExeQue\Remix\Testing\Regexp;

/**
 * Converts a string of hexadecimal values to binary string.
 *
 * @see hex2bin()
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class HexToBin extends StringMutator
{
    use Makes;
    use SanitizesHexStrings;

    protected function mutateString(string $value): string
    {
        $value = $this->sanitizeHexString($value);

        if (preg_match(Regexp::HEX_BYTES, $value, $matches) !== 1) {
            $this->triggerError('Input must have an even number of characters. Got: ', $value);
        }

        return hex2bin($matches['hex']);
    }

    private function triggerError(string $message, string $value)
    {
        $value = Truncate::make(20)->mutate($value);

        return throw new InvalidArgumentException($message . $value);
    }
}
