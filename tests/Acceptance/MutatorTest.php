<?php

declare(strict_types=1);

namespace Tests\Acceptance;

use ExeQue\Remix\Mutate\Mutator;
use Mockery;
use ReflectionClass;

test('method __invoke must be final', function () {
    $reflector = new ReflectionClass(Mutator::class);

    expect($reflector->getMethod('__invoke')->isFinal())->toBeTrue();
});

it('invokes mutate method when invoked as a callable', function () {
    $mutator = Mockery::mock(Mutator::class)->expects('mutate')->once()->getMock();

    $mutator('foo');
});
