<?php

declare(strict_types=1);

namespace ExeQue\Remix\Compare;

/**
 * Checks if the value is identical to the given value. Uses strict comparison.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Same extends Comparator
{
    private mixed $value;

    /**
     * @param mixed $value The value to compare against
     */
    public function __construct(mixed $value)
    {
        $this->value = $value;
    }

    /**
     * @param mixed $value The value to compare against
     */
    public static function make(mixed $value): self
    {
        return new self($value);
    }

    public function check(mixed $value): bool
    {
        return $value === $this->value;
    }
}
