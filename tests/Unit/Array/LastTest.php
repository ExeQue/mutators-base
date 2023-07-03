<?php

declare(strict_types=1);

namespace Tests\Unit\Array;

use ArrayIterator;
use ExeQue\Mutators\Array\Last;

test('retrieves the last element of an array', function () {
    $mutator = Last::make();

    expect($mutator->mutate(['foo', 'bar']))->toBe('bar');
});

test('returns null if the array is empty', function () {
    $mutator = Last::make();

    expect($mutator->mutate([]))->toBeNull();
});

test('works with iterable', function () {
    $mutator = Last::make();

    expect($mutator->mutate(new ArrayIterator(['foo', 'bar'])))->toBe('bar');
});
