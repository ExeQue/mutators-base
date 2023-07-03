<?php

declare(strict_types=1);

namespace Tests\Unit\Array;

use ArrayIterator;
use ExeQue\Mutators\Array\First;

test('retrieves the first element of an array', function () {
    $mutator = First::make();

    expect($mutator->mutate(['foo', 'bar']))->toBe('foo');
});

test('returns null if the array is empty', function () {
    $mutator = First::make();

    expect($mutator->mutate([]))->toBeNull();
});

test('works with iterable', function () {
    $mutator = First::make();

    expect($mutator->mutate(new ArrayIterator(['foo', 'bar'])))->toBe('foo');
});
