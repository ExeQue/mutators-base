<?php

declare(strict_types=1);

namespace Tests\Unit\Array;

use ExeQue\Mutators\Array\Values;

test('retrieves values from an array', function () {
    $mutator = Values::make();

    expect($mutator->mutate(['foo' => 2, 'bar' => 4, 'baz' => 6]))->toBe([2, 4, 6]);
});
