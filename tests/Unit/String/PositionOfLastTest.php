<?php

declare(strict_types=1);

namespace Tests\Unit\String;

use ExeQue\Mutators\Exceptions\InvalidArgumentException;
use ExeQue\Mutators\String\PositionOfLast;

test('fails if encoding is invalid', function () {
    PositionOfLast::make('foo', 0, 'foo');
})->throws(InvalidArgumentException::class, 'Invalid encoding provided. Got: "foo"');

test('gets position of first occurrence', function () {
    $mutator = PositionOfLast::make('foo');

    expect($mutator->mutate('foo bar baz foo bar baz'))->toBe(12);
});

test('outputs false if no occurrence', function () {
    $mutator = PositionOfLast::make('foo');

    expect($mutator->mutate('bar baz bar baz'))->toBe(false);
});
