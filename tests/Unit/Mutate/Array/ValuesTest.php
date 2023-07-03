<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\Array;

use ExeQue\Remix\Mutate\Array\Values;

test('retrieves values from an array', function () {
    $mutator = Values::make();

    expect($mutator->mutate(['foo' => 2, 'bar' => 4, 'baz' => 6]))->toBe([2, 4, 6]);
});
