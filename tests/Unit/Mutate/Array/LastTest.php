<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\Array;

use ArrayIterator;
use ExeQue\Remix\Mutate\Array\Last;

it('retrieves the last element of an array', function () {
    $mutator = Last::make();

    expect($mutator->mutate(['foo', 'bar']))->toBe('bar');
});

it('returns null if the array is empty', function () {
    $mutator = Last::make();

    expect($mutator->mutate([]))->toBeNull();
});

it('uses callback to determine last element', function () {
    $mutator = Last::make(static fn ($value, $key) => str_contains($value, 'o'));

    expect($mutator->mutate(['foo', 'bar']))->toBe('foo');
});

it('returns null if no element matches callback', function () {
    $mutator = Last::make(static fn ($value, $key) => $key === 2);

    expect($mutator->mutate(['foo', 'bar']))->toBeNull();
});

it('callback is provided with value and key', function () {
    $mutator = Last::make(static function ($value, $key) {
        expect($value)->toBe('bar')
            ->and($key)->toBe('foo');

        return true;
    });

    $mutator->mutate(['foo' => 'bar']);
});

it('works with iterable', function () {
    $mutator = Last::make();

    expect($mutator->mutate(new ArrayIterator(['foo', 'bar'])))->toBe('bar');
});
