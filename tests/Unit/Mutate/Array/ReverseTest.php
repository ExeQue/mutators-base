<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\Array;

use ExeQue\Remix\Mutate\Array\Reverse;

test('reverses array', function () {
    $mutator = Reverse::make();

    expect($mutator->mutate(['foo', 'bar']))->toBe(['bar', 'foo']);
});
