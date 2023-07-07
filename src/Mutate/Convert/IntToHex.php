<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\Convert;

use ExeQue\Remix\Assert;
use ExeQue\Remix\Mutate\Mutator;

/**
 * Converts an integer to a hexadecimal string.
 *
 * @see dechex()
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class IntToHex extends Mutator
{
    private int $minLength;

    /**
     * @param  int  $minLength The minimum length of the resulting string. If the resulting string is shorter than this, it will be padded with zeroes (default: 0)
     */
    public function __construct(int $minLength = 0)
    {
        Assert::greaterThanEq($minLength, 0, 'Padding must be a positive integer. Got: %s');

        $this->minLength = $minLength;
    }

    /**
     * @param  int  $minLength The minimum length of the resulting string. If the resulting string is shorter than this, it will be padded with zeroes (default: 0)
     */
    public static function make(int $minLength = 0): self
    {
        return new self($minLength);
    }

    public function mutate(mixed $value): string
    {
        Assert::integerish($value, static::class . ' can only mutate integer values. Got: %s');

        $value = dechex((int)$value);

        return str_pad($value, $this->minLength, '0', STR_PAD_LEFT);
    }
}
