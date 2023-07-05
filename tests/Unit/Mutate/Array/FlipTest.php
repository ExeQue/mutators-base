<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\Array;

use ExeQue\Remix\Mutate\Array\Flip;

it('flips keys and values', function () {
    $mutator = Flip::make();

    expect($mutator->mutate(['foo' => 'bar']))->toBe(['bar' => 'foo']);
});
