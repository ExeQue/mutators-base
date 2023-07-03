<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\Array;

use ExeQue\Remix\Mutate\Array\Only;

test('retrieves only the specified keys from an array', function () {
    $mutator = Only::make(['foo', 'bar']);

    expect($mutator->mutate(['foo' => 2, 'bar' => 4, 'baz' => 6]))->toBe(['foo' => 2, 'bar' => 4]);
});
