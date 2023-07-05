<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\Array;

use ArrayIterator;
use ExeQue\Remix\Mutate\Array\At;

it('get the element at a given index with a list', function () {
    $mutator = At::make(1);

    expect($mutator->mutate(['foo', 'bar', 'baz']))->toBe('bar');
});

it('returns null if the index is out of bounds with a list', function () {
    $mutator = At::make(3);

    expect($mutator->mutate(['foo', 'bar', 'baz']))->toBeNull();
});

it('get the element at a given index in reverse when index is negative with a list', function () {
    $mutator = At::make(-1);

    expect($mutator->mutate(['foo', 'bar', 'baz']))->toBe('baz');
});

it('returns null if the index is out of bounds in reverse with a list', function () {
    $mutator = At::make(-4);

    expect($mutator->mutate(['foo', 'bar', 'baz']))->toBeNull();
});

it('returns null if the index is not an integer when given a list', function () {
    $mutator = At::make('foo');

    expect($mutator->mutate(['foo', 'bar', 'baz']))->toBeNull();
});

it('get the element at a given index with a map', function () {
    $mutator = At::make('foo');

    expect($mutator->mutate(['foo' => 'bar', 'baz' => 'qux']))->toBe('bar');
});

it('returns null if the index is not found with a map', function () {
    $mutator = At::make('qux');

    expect($mutator->mutate(['foo' => 'bar', 'baz' => 'qux']))->toBeNull();
});

it('returns null if the index is not a string when given a map', function () {
    $mutator = At::make(0);

    expect($mutator->mutate(['foo' => 'bar', 'baz' => 'qux']))->toBeNull();
});

it('default value can be set when the index does not exist', function () {
    $mutator = At::make('qux', 'foo');

    expect($mutator->mutate(['foo' => 'bar', 'baz' => 'qux']))->toBe('foo');
});

it('default value can be set from a callable when the index does not exist', function () {
    $mutator = At::make('qux', fn () => 'foo');

    expect($mutator->mutate(['foo' => 'bar', 'baz' => 'qux']))->toBe('foo');
});

it('default value from callable is given input array and index', function () {
    $mutator = At::make('qux', function ($array, $index) {
        expect($array)->toBe(['foo' => 'bar', 'baz' => 'qux'])
            ->and($index)->toBe('qux');

        return 'foo';
    });

    $mutator->mutate(['foo' => 'bar', 'baz' => 'qux']);
});

it('works with iterable', function () {
    $mutator = At::make(1);

    expect($mutator->mutate(new ArrayIterator(['foo', 'bar', 'baz'])))->toBe('bar');
});
