<?php

declare(strict_types=1);

namespace ExeQue\Remix\Serialize;

interface SerializerInterface
{
    public function encode(mixed $value): string;

    public function decode(mixed $value): mixed;
}
