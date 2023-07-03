<?php

declare(strict_types=1);

namespace Tests\Unit\Array;

use ExeQue\Mutators\Array\Flip;

test('flips keys and values', function () {
    $mutator = Flip::make();

    expect($mutator->mutate(['foo' => 'bar']))->toBe(['bar' => 'foo']);
});
