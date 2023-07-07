<?php

declare(strict_types=1);

namespace ExeQue\Remix\Data;

final class Regexp
{
    /**
     * Hexadecimal characters.
     */
    public const HEX = '/^(0x){0,1}(?<hex>[A-Fa-f0-9]*)$/';

    /**
     * Hexadecimal bytes (2 characters per byte).
     * Example: 0af3e91b
     */
    public const HEX_BYTES = '/^(0x){0,1}(?<hex>([A-Fa-f0-9]{2})*)$/';

    /**
     * Hexadecimal bytes (2 characters per byte) with spaces between each byte.
     * Example: 0a f3 e9 1b
     */
    public const HEX_BYTES_WITH_SPACES = '/^([A-Fa-f0-9]{2}\s?)*([A-Fa-f0-9]{2})$/';
}
