<?php

declare(strict_types=1);

namespace ExeQue\Remix\Data;

enum HexFormat
{
    /**
     * Prefixed hex format, with 0x prefix. No spaces.
     */
    case Prefixed;

    /**
     * Bytes format, no prefix, with spaces between every 2 characters (1 byte).
     */
    case BytesString;

    case BytesArray;

    /**
     * Raw hex format. No prefix, No spaces.
     */
    case Raw;
}
