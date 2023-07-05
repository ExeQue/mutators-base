<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate;

use ExeQue\Remix\Compare\Comparator;
use Mockery;

it('invokes compare method when invoked as a callable', function () {
    $mutator = Mockery::mock(Comparator::class)->expects('check')->once()->getMock();

    $mutator('foo');
});
