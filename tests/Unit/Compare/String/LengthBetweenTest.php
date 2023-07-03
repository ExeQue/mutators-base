<?php

declare(strict_types=1);

namespace Tests\Unit\Compare\Countable;

use ExeQue\Remix\Compare\String\LengthBetween;
use ExeQue\Remix\Exceptions\InvalidArgumentException;

test('length is between min and max', function () {
    $comparator = LengthBetween::make(1, 3);

    expect($comparator->check('ab'))->toBe(true);
});

test('length is equal to min', function () {
    $comparator = LengthBetween::make(1, 3);

    expect($comparator->check('a'))->toBe(true);
});

test('length is equal to max', function () {
    $comparator = LengthBetween::make(1, 3);

    expect($comparator->check('abc'))->toBe(true);
});

test('length is less than min', function () {
    $comparator = LengthBetween::make(1, 3);

    expect($comparator->check(''))->toBe(false);
});

test('length is greater than max', function () {
    $comparator = LengthBetween::make(1, 3);

    expect($comparator->check('abcd'))->toBe(false);
});

test('length is equal to min when not inclusive', function () {
    $comparator = LengthBetween::make(1, 3, false);

    expect($comparator->check('a'))->toBe(false);
});

test('length is equal to max when not inclusive', function () {
    $comparator = LengthBetween::make(1, 3, false);

    expect($comparator->check('abc'))->toBe(false);
});

test('fails if given min less than zero', function () {
    LengthBetween::make(-1, 3);
})->throws(InvalidArgumentException::class);
