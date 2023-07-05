<?php

declare(strict_types=1);

namespace ExeQue\Remix\Serialize;

interface SerializerInterface
{
    public function encode(mixed $value): mixed;

    public function decode(mixed $value): mixed;
}
