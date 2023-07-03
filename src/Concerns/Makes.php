<?php

declare(strict_types=1);

namespace ExeQue\Remix\Concerns;

trait Makes
{
    public static function make(): self
    {
        return new self();
    }
}
