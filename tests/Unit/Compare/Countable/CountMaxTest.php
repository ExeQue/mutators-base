<?php

declare(strict_types=1);

namespace Tests\Unit\Compare\Countable;

use ExeQue\Remix\Compare\Countable\CountMax;
use ExeQue\Remix\Exceptions\InvalidArgumentException;

it('count is less than maximum', function () {
    $comparator = CountMax::make(2);

    expect($comparator->check([1]))->toBe(true);
});

it('count is equal to maximum', function () {
    $comparator = CountMax::make(2);

    expect($comparator->check([1, 2]))->toBe(true);
});

it('count is greater than maximum', function () {
    $comparator = CountMax::make(2);

    expect($comparator->check([1, 2, 3]))->toBe(false);
});

it('count is equal to maximum when not inclusive', function () {
    $comparator = CountMax::make(2, false);

    expect($comparator->check([1, 2]))->toBe(false);
});

it('fails if given maximum less than zero', function () {
    CountMax::make(-1);
})->throws(InvalidArgumentException::class);
