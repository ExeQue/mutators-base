<?php

declare(strict_types=1);

namespace Tests\Unit\String;

use ExeQue\Mutators\Exceptions\InvalidArgumentException;
use ExeQue\Mutators\String\PositionOf;

test('fails if encoding is invalid', function () {
    PositionOf::make('foo', 0, 'foo');
})->throws(InvalidArgumentException::class, 'Invalid encoding provided. Got: "foo"');

test('gets position of first occurrence', function () {
    $mutator = PositionOf::make('foo');

    expect($mutator->mutate('foo bar baz foo bar baz'))->toBe(0);
});

test('outputs false if no occurrence', function () {
    $mutator = PositionOf::make('foo');

    expect($mutator->mutate('bar baz bar baz'))->toBe(false);
});
