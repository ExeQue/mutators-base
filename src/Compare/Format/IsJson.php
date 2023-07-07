<?php

declare(strict_types=1);

namespace ExeQue\Remix\Compare\Format;

use ExeQue\Remix\Compare\String\StringComparator;

/**
 * Checks if a string is a valid JSON string.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class IsJson extends StringComparator
{
    private int $depth;
    private int $flags;

    /**
     * @param  int  $depth Maximum depth of the JSON string (default: 512).
     * @param  int  $flags Bitmask of JSON decode flags. JSON_THROW_ON_ERROR is not allowed and will be stripped if applied (default: 0).
     */
    public function __construct(int $depth = 512, int $flags = 0)
    {
        $this->depth = $depth;
        $this->flags = $flags;

        if ($this->flags & JSON_THROW_ON_ERROR) {
            $this->flags ^= JSON_THROW_ON_ERROR;
        }
    }

    /**
     * @param  int  $depth Maximum depth of the JSON string (default: 512).
     * @param  int  $flags Bitmask of JSON decode flags. JSON_THROW_ON_ERROR is not allowed and will be stripped if applied (default: 0).
     */
    public static function make(int $depth = 512, int $flags = 0): self
    {
        return new self($depth, $flags);
    }

    protected function checkString(string $value): bool
    {
        /** @noinspection JsonEncodingApiUsageInspection */
        json_decode($value, true, $this->depth, $this->flags);

        return json_last_error() === JSON_ERROR_NONE;
    }
}
