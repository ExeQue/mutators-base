<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\Array;

use ExeQue\Remix\Mutate\Array\Keys;

it('retrieves keys from an array', function () {
    $mutator = Keys::make();

    expect($mutator->mutate(['foo' => 2, 'bar' => 4, 'baz' => 6]))->toBe(['foo', 'bar', 'baz']);
});
