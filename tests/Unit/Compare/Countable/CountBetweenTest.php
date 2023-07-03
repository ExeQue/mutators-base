<?php

declare(strict_types=1);

namespace Tests\Unit\Compare\Countable;

use ExeQue\Remix\Compare\Countable\CountBetween;
use ExeQue\Remix\Exceptions\InvalidArgumentException;

test('count is between min and max', function () {
    $comparator = CountBetween::make(1, 3);

    expect($comparator->check([1, 2]))->toBe(true);
});

test('count is equal to min', function () {
    $comparator = CountBetween::make(1, 3);

    expect($comparator->check([1]))->toBe(true);
});

test('count is equal to max', function () {
    $comparator = CountBetween::make(1, 3);

    expect($comparator->check([1, 2, 3]))->toBe(true);
});

test('count is greater than max', function () {
    $comparator = CountBetween::make(1, 3);

    expect($comparator->check([1, 2, 3, 4]))->toBe(false);
});

test('count is less than min', function () {
    $comparator = CountBetween::make(1, 3);

    expect($comparator->check([]))->toBe(false);
});

test('count is between min and max (exclusive)', function () {
    $comparator = CountBetween::make(1, 3, false);

    expect($comparator->check([1, 2]))->toBe(true);
});

test('count is equal to min (exclusive)', function () {
    $comparator = CountBetween::make(1, 3, false);

    expect($comparator->check([1]))->toBe(false);
});

test('count is equal to max (exclusive)', function () {
    $comparator = CountBetween::make(1, 3, false);

    expect($comparator->check([1, 2, 3]))->toBe(false);
});

test('count is greater than max (exclusive)', function () {
    $comparator = CountBetween::make(1, 3, false);

    expect($comparator->check([1, 2, 3, 4]))->toBe(false);
});

test('count is less than min (exclusive)', function () {
    $comparator = CountBetween::make(1, 3, false);

    expect($comparator->check([]))->toBe(false);
});

test('fails if given min less than zero', function () {
    CountBetween::make(-1, 3);
})->throws(InvalidArgumentException::class);

test('fails if given max less than zero', function () {
    CountBetween::make(1, -3);
})->throws(InvalidArgumentException::class);

test('fails if given min greater than max', function () {
    CountBetween::make(3, 1);
})->throws(InvalidArgumentException::class);
