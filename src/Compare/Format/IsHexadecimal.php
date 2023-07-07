<?php

declare(strict_types=1);

namespace ExeQue\Remix\Compare\Format;

use ExeQue\Remix\Compare\String\StringComparator;
use ExeQue\Remix\Data\Regexp;

/**
 * Checks if a string is hexadecimal. Optionally allows spaces between each byte.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class IsHexadecimal extends StringComparator
{
    private bool $bytes;

    /**
     * @param  bool  $bytes If true, spaces between every byte (2 characters) is required (eg. 00 11 22 33) instead of 00112233. (default: false)
     */
    public function __construct(bool $bytes = false)
    {
        $this->bytes = $bytes;
    }

    /**
     * @param  bool  $bytes If true, spaces between every byte (2 characters) is required (eg. 00 11 22 33) instead of 00112233. (default: false)
     */
    public static function make(bool $bytes = false): self
    {
        return new self($bytes);
    }

    protected function checkString(string $value): bool
    {
        if ($this->bytes) {
            return preg_match(Regexp::HEX_BYTES_WITH_SPACES, $value) === 1;
        }

        return preg_match(Regexp::HEX, $value) === 1;
    }
}
