<?php

declare(strict_types=1);

namespace Tests\Unit;

use ExeQue\Mutators\Alias;
use ExeQue\Mutators\Mutator;
use Mockery;
use ReflectionClass;

test('calls wrapped mutator', function () {
    $mutator = Mockery::mock(Mutator::class)->expects('mutate')->once()->andReturn('foo')->getMock();

    $implementation = new class($mutator) extends Alias
    {
    };

    expect($implementation->mutate('bar'))->toBe('foo');
});

test('does not replace wrapped instance', function () {
    $mutator = Mockery::mock(Mutator::class);

    $implementation = new class($mutator) extends Alias
    {
    };

    $reflector = new ReflectionClass($implementation);
    $property  = $reflector->getParentClass()->getProperty('mutator');

    expect($property->getValue($implementation))->toBe($mutator);
});
