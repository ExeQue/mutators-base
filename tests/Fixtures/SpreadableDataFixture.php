<?php

declare(strict_types=1);

namespace Tests\Fixtures;

class SpreadableDataFixture
{
    public function __construct(
        public string $name,
        public int $age,
        public string $address,
    ) {
    }
}
