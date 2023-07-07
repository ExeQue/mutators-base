<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\Array;

// Create tests for the following classes: Filter

use ExeQue\Remix\Mutate\Array\Filter;

it('should filter an array', function () {
    $mutator = Filter::make();

    expect($mutator->mutate(['foo', 'bar', 'baz', null, false]))->toBe(['foo', 'bar', 'baz']);
});

it('preserves keys when filtering an array', function () {
    $mutator = Filter::make();

    expect($mutator->mutate(['foo', 'bar', 'baz', null, false]))->toBe([0 => 'foo', 1 => 'bar', 2 => 'baz']);
});

it('gives value and key to callback', function () {
    $mutator = Filter::make(function ($value, $key) {
        expect($value)->toBe('foo')
            ->and($key)->toBe(0);
    });

    $mutator->mutate(['foo']);
});
