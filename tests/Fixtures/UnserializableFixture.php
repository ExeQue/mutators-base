<?php

declare(strict_types=1);

namespace Tests\Fixtures;

use Exception;

class UnserializableFixture
{
    public function __serialize(): array
    {
        throw new Exception('This class is not serializable');
    }

    public function __wakeup(): void
    {
        throw new Exception('This class is not deserializable');
    }
}
