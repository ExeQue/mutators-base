<?php

declare(strict_types=1);

namespace Tests\Unit\Concerns;

use ExeQue\Remix\Concerns\Makes;

it('returns instance of implementer', function () {
    $implementation = new class () {
        use Makes;
    };

    $instance = $implementation::make();

    expect($instance)->toBeInstanceOf($implementation::class);
});
