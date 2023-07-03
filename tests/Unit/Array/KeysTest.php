<?php

declare(strict_types=1);

namespace Tests\Unit\Array;

use ExeQue\Mutators\Array\Keys;

test('retrieves keys from an array', function () {
    $mutator = Keys::make();

    expect($mutator->mutate(['foo' => 2, 'bar' => 4, 'baz' => 6]))->toBe(['foo', 'bar', 'baz']);
});
