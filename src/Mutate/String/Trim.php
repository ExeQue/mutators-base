<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\String;

use ExeQue\Remix\Data\StringDirection;

/**
 * Trims a string with specified direction and characters
 *
 * @see trim()
 * @see ltrim()
 * @see rtrim()
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Trim extends StringMutator
{
    private StringDirection $direction;
    private string $characters;

    /**
     * @param  StringDirection  $direction The direction to trim (default: StringDirection::Both).
     * @param  string|null  $characters The characters to trim (default: ` \t\n\r\0\x0B`).
     */
    public function __construct(StringDirection $direction = StringDirection::Both, string $characters = null)
    {
        $this->direction  = $direction;
        $this->characters = $characters ?? $this->resolveDefaultCharacters();
    }

    /**
     * @param  StringDirection  $direction The direction to trim (default: StringDirection::Both).
     * @param  string|null  $characters The characters to trim (default: ` \t\n\r\0\x0B`).
     */
    public static function make(StringDirection $direction = StringDirection::Both, string $characters = null): self
    {
        return new self($direction, $characters);
    }

    /**
     * @param  string|null  $characters The characters to trim (default: ` \t\n\r\0\x0B`).
     */
    public static function left(string $characters = null): self
    {
        return new self(StringDirection::Left, $characters);
    }

    /**
     * @param  string|null  $characters The characters to trim (default: ` \t\n\r\0\x0B`).
     */
    public static function right(string $characters = null): self
    {
        return new self(StringDirection::Right, $characters);
    }

    /**
     * @param  string|null  $characters The characters to trim (default: ` \t\n\r\0\x0B`).
     */
    public static function both(string $characters = null): self
    {
        return new self(StringDirection::Both, $characters);
    }

    protected function mutateString(string $value): string
    {
        return match ($this->direction) {
            StringDirection::Left  => ltrim($value, $this->characters),
            StringDirection::Right => rtrim($value, $this->characters),
            StringDirection::Both  => trim($value, $this->characters)
        };
    }

    private function resolveDefaultCharacters(): string
    {
        return " \t\n\r\0\x0B";
    }
}
