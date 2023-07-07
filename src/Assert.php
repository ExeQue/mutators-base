<?php

declare(strict_types=1);

namespace ExeQue\Remix;

use ExeQue\Remix\Exceptions\InvalidArgumentException;
use Stringable;
use Webmozart\Assert\Assert as WebmozartAssert;

/**
 * @internal
 */
class Assert extends WebmozartAssert
{
    protected static function reportInvalidArgument($message): void
    {
        throw new InvalidArgumentException($message);
    }

    /**
     * @throws InvalidArgumentException
     */
    public static function report(string $message, ...$values): void
    {
        self::reportInvalidArgument(self::format($message, ...$values));
    }

    public static function format(string $message, ...$values): string
    {
        foreach ($values as $i => $value) {
            $values[$i] = self::valueToString($value);
        }

        return vsprintf($message, $values);
    }

    public static function stringable(mixed $value, string $message = ''): void
    {
        if (is_string($value) || is_null($value) || is_numeric($value) || $value instanceof Stringable) {
            return;
        }

        self::reportInvalidArgument(sprintf(
            $message ?: 'Expected a stringable value. Got: %s',
            self::valueToString($value)
        ));
    }

    public static function allStringable($values, string $message = ''): void
    {
        self::isIterable($values, $message);

        foreach ($values as $value) {
            self::stringable($value, $message);
        }
    }

    public static function intOrFloat(mixed $value, string $message = ''): void
    {
        if (is_int($value) || is_float($value)) {
            return;
        }

        self::reportInvalidArgument(sprintf(
            $message ?: 'Expected an integer or float. Got: %s',
            self::valueToString($value)
        ));
    }

    public static function allIntOrFloat($values, string $message = ''): void
    {
        self::isIterable($values, $message);

        foreach ($values as $value) {
            self::intOrFloat($value, $message);
        }
    }

    public static function traitExists(string $trait, string $message = ''): void
    {
        if (! trait_exists($trait)) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected trait to exist. Got: %s',
                self::valueToString($trait)
            ));
        }
    }
}
