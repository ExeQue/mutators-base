<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\String;

use ExeQue\Remix\Exceptions\InvalidArgumentException;
use ExeQue\Remix\Mutate\String\PositionOfLast;

it('fails if encoding is invalid', function () {
    PositionOfLast::make('foo', 0, 'foo');
})->throws(InvalidArgumentException::class, 'Invalid encoding provided. Got: "foo"');

it('gets position of first occurrence', function () {
    $mutator = PositionOfLast::make('foo');

    expect($mutator->mutate('foo bar baz foo bar baz'))->toBe(12);
});

it('outputs false if no occurrence', function () {
    $mutator = PositionOfLast::make('foo');

    expect($mutator->mutate('bar baz bar baz'))->toBe(false);
});
