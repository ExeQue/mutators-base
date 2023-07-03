<?php

declare(strict_types=1);

namespace Tests\Unit\Compare\Countable;

use ExeQue\Remix\Compare\String\LengthMax;
use ExeQue\Remix\Exceptions\InvalidArgumentException;

test('length is less than maximum', function () {
    $comparator = LengthMax::make(2);

    expect($comparator->check('a'))->toBe(true);
});

test('length is equal to maximum', function () {
    $comparator = LengthMax::make(2);

    expect($comparator->check('ab'))->toBe(true);
});

test('length is greater than maximum', function () {
    $comparator = LengthMax::make(2);

    expect($comparator->check('abc'))->toBe(false);
});

test('length is equal to maximum when not inclusive', function () {
    $comparator = LengthMax::make(2, false);

    expect($comparator->check('ab'))->toBe(false);
});

test('fails if given maximum less than zero', function () {
    LengthMax::make(-1);
})->throws(InvalidArgumentException::class);
