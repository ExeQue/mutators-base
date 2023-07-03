<?php

declare(strict_types=1);

namespace Tests\Unit;

use ExeQue\Mutators\Mutator;
use Mockery;

test('invokes mutate method when invoked as a callable', function () {
    $mutator = Mockery::mock(Mutator::class)->expects('mutate')->once()->getMock();

    $mutator('foo');
});
