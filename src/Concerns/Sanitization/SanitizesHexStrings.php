<?php

declare(strict_types=1);

namespace ExeQue\Remix\Concerns\Sanitization;

use ExeQue\Remix\Data\Regexp;
use PHPUnit\Framework\Attributes\CodeCoverageIgnore;

/**
 * Not yet in use - Should be used for later sanitization of hex strings once implemented.
 */
#[CodeCoverageIgnore]
trait SanitizesHexStrings
{
    protected function sanitizeHexString(string $value): string
    {
        $value = $this->sanitizeHexByteStringWithSpaces($value);

        return $this->stripHexPrefix($value);
    }

    private function stripHexPrefix(string $value): string
    {
        if (str_starts_with($value, '0x')) {
            $value = substr($value, 2);
        }

        return $value;
    }

    private function sanitizeHexByteStringWithSpaces(string $value): string
    {
        if (preg_match(Regexp::HEX_BYTES_WITH_SPACES, $value) === 1) {
            $value = str_replace(' ', '', $value);
        }

        return $value;
    }
}
