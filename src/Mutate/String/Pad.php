<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\String;

use ExeQue\Remix\Assert;
use ExeQue\Remix\Concerns\Definitions\UsesEncoding;
use ExeQue\Remix\Data\StringDirection;

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

    /**
     * @param  int  $length The length to pad to.
     * @param  string  $string The string to pad with (default: ' ').
     * @param  StringDirection  $direction The direction to pad in (default: StringDirection::Right).
     * @param  string|null  $encoding The encoding to use (optional).
     */
    public function __construct(int $length, string $string = ' ', StringDirection $direction = StringDirection::Right, string $encoding = null)
    {
        Assert::greaterThanEq($length, 0, 'Length must be greater than or equal to 0. Got: %s');

        $this->length    = $length;
        $this->string    = $string;
        $this->direction = $direction;

        $this->setEncoding($encoding);
    }

    /**
     * @param  int  $length The length to pad to.
     * @param  string  $string The string to pad with (default: ' ').
     * @param  StringDirection  $direction The direction to pad in (default: StringDirection::Right).
     * @param  string|null  $encoding The encoding to use (optional).
     */
    public static function make(int $length, string $string = ' ', StringDirection $direction = StringDirection::Right, string $encoding = null): self
    {
        return new self($length, $string, $direction, $encoding);
    }

    /**
     * @param  int  $length The length to pad to.
     * @param  string  $string The string to pad with (default: ' ').
     * @param  string|null  $encoding The encoding to use (optional).
     */
    public static function left(int $length, string $string = ' ', string $encoding = null): self
    {
        return new self($length, $string, StringDirection::Left, $encoding);
    }

    /**
     * @param  int  $length The length to pad to.
     * @param  string  $string The string to pad with (default: ' ').
     * @param  string|null  $encoding The encoding to use (optional).
     */
    public static function right(int $length, string $string = ' ', string $encoding = null): self
    {
        return new self($length, $string, StringDirection::Right, $encoding);
    }

    /**
     * @param  int  $length The length to pad to.
     * @param  string  $string The string to pad with (default: ' ').
     * @param  string|null  $encoding The encoding to use (optional).
     */
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
