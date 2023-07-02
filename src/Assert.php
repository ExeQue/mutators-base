<?php

declare(strict_types=1);

namespace ExeQue\Mutators;

use ExeQue\Mutators\Exceptions\InvalidArgumentException;
use PHPUnit\Framework\Attributes\CodeCoverageIgnore;
use Webmozart\Assert\Assert as WebmozartAssert;

/**
 * @internal
 */
#[CodeCoverageIgnore(self::class)]
class Assert extends WebmozartAssert
{
    protected static function reportInvalidArgument($message): void
    {
        throw new InvalidArgumentException($message);
    }

    public static function report(string $message, ...$values): void
    {
        foreach ($values as $i => $value) {
            $values[$i] = self::valueToString($value);
        }

        self::reportInvalidArgument(vsprintf($message, $values));
    }
}
