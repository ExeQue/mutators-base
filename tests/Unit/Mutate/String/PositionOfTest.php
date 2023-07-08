<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\String;

use ExeQue\Remix\Exceptions\InvalidArgumentException;
use ExeQue\Remix\Mutate\String\PositionOf;

it('fails if encoding is invalid', function () {
    PositionOf::make('foo', encoding: 'foo');
})->throws(InvalidArgumentException::class, 'Invalid encoding provided. Got: "foo"');

it('gets position of the first occurrence', function () {
    $mutator = PositionOf::make('baz');

    expect($mutator->mutate('foo bar baz foo bar baz'))->toBe(8);
});

it('gets position of the first occurrence using alias', function () {
    $mutator = PositionOf::first('baz');

    expect($mutator->mutate('foo bar baz foo bar baz'))->toBe(8);
});

it('gets position of the first occurrence with offset', function () {
    $mutator = PositionOf::make('baz', offset: 9);

    expect($mutator->mutate('foo bar baz foo bar baz'))->toBe(20);
});

it('gets position of the last occurrence', function () {
    $mutator = PositionOf::make('foo', true);

    expect($mutator->mutate('foo bar baz foo bar baz'))->toBe(12);
});

it('gets position of the last occurrence using alias', function () {
    $mutator = PositionOf::last('foo');

    expect($mutator->mutate('foo bar baz foo bar baz'))->toBe(12);
});

it('gets position of the last occurrence with offset', function () {
    $mutator = PositionOf::make('baz', true, 8);

    expect($mutator->mutate('foo bar baz foo bar baz'))->toBe(8);
});

it('outputs false if no occurrence', function () {
    $mutator = PositionOf::make('foo');

    expect($mutator->mutate('bar baz bar baz'))->toBe(false);
});
