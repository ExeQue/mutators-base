<?php

declare(strict_types=1);

namespace Tests\Unit;

use ExeQue\Remix\Compare\Comparator;
use ExeQue\Remix\Compare\ComparatorAlias;
use ExeQue\Remix\Mutate\Mutator;
use ExeQue\Remix\Mutate\MutatorAlias;
use Mockery;

it('calls wrapped mutator', function () {
    $mutator = Mockery::mock(Mutator::class)->expects('mutate')->once()->andReturn('foo')->getMock();

    $implementation = new class($mutator) extends MutatorAlias
    {
    };

    expect($implementation->mutate('bar'))->toBe('foo');
});

it('calls wrapped comparator', function () {
    $comparator = Mockery::mock(Comparator::class)->expects('check')->once()->andReturn(true)->getMock();

    $implementation = new class($comparator) extends ComparatorAlias
    {
    };

    expect($implementation->check(''))->toBe(true);
});
