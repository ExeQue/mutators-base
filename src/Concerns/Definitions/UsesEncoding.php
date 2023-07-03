<?php

declare(strict_types=1);

namespace ExeQue\Remix\Concerns\Definitions;

use ExeQue\Remix\Concerns\Validation\ValidatesEncoding;

/**
 * @internal
 */
trait UsesEncoding
{
    use ValidatesEncoding;

    protected ?string $encoding;

    protected function setEncoding(?string $encoding): void
    {
        $this->encoding = $encoding;

        $this->validateEncoding($encoding);
    }

    protected function getEncoding(string $input = null): ?string
    {
        if ($input === null) {
            return $this->encoding;
        }

        return $this->encoding ?? mb_detect_encoding($input);
    }
}
