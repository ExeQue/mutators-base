<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\Array;

// Create tests for the following classes: Implode

use ArrayIterator;
use ExeQue\Remix\Mutate\Array\Implode;

it('should implode an array', function () {
    $mutator = Implode::make();

    expect($mutator->mutate(['foo', 'bar', 'baz']))->toBe('foobarbaz');
});

it('should use final glue when imploding an array with more than 2 elements', function () {
    $mutator = Implode::make(', ', ' and ');

    expect($mutator->mutate(['foo', 'bar', 'baz']))->toBe('foo, bar and baz');
});

it('should skip imploding when array has 0 or 1 elements', function () {
    $mutator = Implode::make();

    expect($mutator->mutate([]))->toBe('')
        ->and($mutator->mutate(['foo']))->toBe('foo');
});

it('works with iterables', function () {
    $mutator = Implode::make();

    expect($mutator->mutate(new ArrayIterator(['foo', 'bar', 'baz'])))->toBe('foobarbaz');
});
