<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\Array;

use ExeQue\Remix\Mutate\Array\Wrap;

test('wraps value if not already an array', function () {
    $mutator = Wrap::make();

    expect($mutator->mutate('foo'))->toBe(['foo']);
});

test('does not wrap value if already an array', function () {
    $mutator = Wrap::make();

    expect($mutator->mutate(['foo']))->toBe(['foo']);
});
