<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\Convert;

use ExeQue\Remix\Assert;
use ExeQue\Remix\Concerns\Makes;
use ExeQue\Remix\Concerns\Sanitization\SanitizesHexStrings;
use ExeQue\Remix\Data\Regexp;
use ExeQue\Remix\Exceptions\InvalidArgumentException;
use ExeQue\Remix\Mutate\Mutator;
use ExeQue\Remix\Mutate\String\Truncate;

/**
 * Converts a hexadecimal string to an integer.
 *
 * @see hexdec()
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class HexToInt extends Mutator
{
    use Makes;
    use SanitizesHexStrings;

    public function mutate(mixed $value): int
    {
        Assert::string($value, static::class . ' can only mutate string values. Got: %s');

        $value = $this->sanitizeHexString($value);

        if (preg_match(Regexp::HEX, $value, $matches) !== 1) {
            $value = Truncate::make(20)->mutate($value);

            throw new InvalidArgumentException('Input is not a valid hexadecimal string. Got: ' . $value);
        }

        return (int)hexdec($matches['hex']);
    }
}
