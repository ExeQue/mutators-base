<?php

declare(strict_types=1);

namespace ExeQue\Remix\Compare;

/**
 * Checks if the value is equal to the given value. Uses loose comparison.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Equal extends Comparator
{
    private mixed $value;

    public function __construct(mixed $value)
    {
        $this->value = $value;
    }

    public static function make(mixed $value): self
    {
        return new self($value);
    }

    public function check(mixed $value): bool
    {
        /** @noinspection TypeUnsafeComparisonInspection */
        return $value == $this->value;
    }
}
