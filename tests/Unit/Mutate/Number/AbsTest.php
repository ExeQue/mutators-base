<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\Number;

use ExeQue\Remix\Mutate\Number\Abs;

it('should return the absolute value of a number', function () {
    $mutator = Abs::make();

    expect($mutator->mutate(-1))->toBe(1)
        ->and($mutator->mutate(1))->toBe(1)
        ->and($mutator->mutate(0))->toBe(0);
});
