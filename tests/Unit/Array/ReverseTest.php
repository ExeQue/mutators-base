<?php

declare(strict_types=1);

namespace Tests\Unit\Array;

use ExeQue\Mutators\Array\Reverse;

test('reverses array', function () {
    $mutator = Reverse::make();

    expect($mutator->mutate(['foo', 'bar']))->toBe(['bar', 'foo']);
});
