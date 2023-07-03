<?php

declare(strict_types=1);

namespace Tests\Unit\Compare\Countable;

use ExeQue\Remix\Compare\Countable\CountMax;
use ExeQue\Remix\Exceptions\InvalidArgumentException;

test('count is less than maximum', function () {
    $comparator = CountMax::make(2);

    expect($comparator->check([1]))->toBe(true);
});

test('count is equal to maximum', function () {
    $comparator = CountMax::make(2);

    expect($comparator->check([1, 2]))->toBe(true);
});

test('count is greater than maximum', function () {
    $comparator = CountMax::make(2);

    expect($comparator->check([1, 2, 3]))->toBe(false);
});

test('count is equal to maximum when not inclusive', function () {
    $comparator = CountMax::make(2, false);

    expect($comparator->check([1, 2]))->toBe(false);
});

test('fails if given maximum less than zero', function () {
    CountMax::make(-1);
})->throws(InvalidArgumentException::class);
