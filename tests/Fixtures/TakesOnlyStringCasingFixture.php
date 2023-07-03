<?php

declare(strict_types=1);

namespace Tests\Fixtures;

use ExeQue\Remix\Concerns\Definitions\TakesOnlyStringCasing;
use ExeQue\Remix\Data\StringCase;

class TakesOnlyStringCasingFixture
{
    use TakesOnlyStringCasing;

    public function get(): StringCase
    {
        return $this->casing;
    }
}
