<?php

declare(strict_types=1);

namespace Tests\Acceptance;

use ExeQue\Remix\Compare\Comparator;
use Mockery;
use ReflectionClass;

test('method __invoke must be final', function () {
    $reflector = new ReflectionClass(Comparator::class);

    expect($reflector->getMethod('__invoke')->isFinal())->toBeTrue();
});

it('invokes check method when invoked as a callable', function () {
    $mutator = Mockery::mock(Comparator::class)->expects('check')->once()->getMock();

    $mutator('foo');
});
