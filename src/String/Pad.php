<?php

declare(strict_types=1);

namespace ExeQue\Mutators\String;

use ExeQue\Mutators\Assert;
use ExeQue\Mutators\Concerns\Definitions\UsesEncoding;
use ExeQue\Mutators\Data\StringDirection;

/**
 * Pads a string to a given length with another string with specified direction.
 *
 * @see mb_str_pad()
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Pad extends StringMutator
{
    use UsesEncoding;

    private int $length;
    private string $string;
    private StringDirection $direction;

    public function __construct(int $length, string $string = ' ', StringDirection $direction = StringDirection::Right, string $encoding = null)
    {
        Assert::greaterThanEq($length, 0, 'Length must be greater than or equal to 0. Got: %s');

        $this->length    = $length;
        $this->string    = $string;
        $this->direction = $direction;

        $this->setEncoding($encoding);
    }

    public static function make(int $length, string $string = ' ', StringDirection $direction = StringDirection::Right, string $encoding = null): self
    {
        return new self($length, $string, $direction, $encoding);
    }

    public static function left(int $length, string $string = ' ', string $encoding = null): self
    {
        return new self($length, $string, StringDirection::Left, $encoding);
    }

    public static function right(int $length, string $string = ' ', string $encoding = null): self
    {
        return new self($length, $string, StringDirection::Right, $encoding);
    }

    public static function both(int $length, string $string = ' ', string $encoding = null): self
    {
        return new self($length, $string, StringDirection::Both, $encoding);
    }

    protected function mutateString(string $value): string
    {
        return mb_str_pad($value, $this->length, $this->string, $this->resolveDirection(), $this->getEncoding($value));
    }

    private function resolveDirection(): int
    {
        return match ($this->direction) {
            StringDirection::Left  => STR_PAD_LEFT,
            StringDirection::Right => STR_PAD_RIGHT,
            StringDirection::Both  => STR_PAD_BOTH,
        };
    }
}
