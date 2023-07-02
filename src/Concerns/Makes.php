<?php

declare(strict_types=1);

namespace ExeQue\Mutators\Concerns;

trait Makes
{
    public static function make(): self
    {
        return new static();
    }
}
