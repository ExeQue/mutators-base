<?php

declare(strict_types=1);

namespace Tests\Unit\Compare\Countable;

use ExeQue\Remix\Compare\Countable\CountMin;
use ExeQue\Remix\Exceptions\InvalidArgumentException;

it('count is greater than minimum', function () {
    $comparator = CountMin::make(2);

    expect($comparator->check([1, 2, 3, 4]))->toBe(true);
});

it('count is equal to minimum', function () {
    $comparator = CountMin::make(2);

    expect($comparator->check([1, 2]))->toBe(true);
});

it('count is less than minimum', function () {
    $comparator = CountMin::make(2);

    expect($comparator->check([1]))->toBe(false);
});

it('count is equal to minimum when not inclusive', function () {
    $comparator = CountMin::make(2, false);

    expect($comparator->check([1, 2]))->toBe(false);
});

it('fails if given minimum less than zero', function () {
    CountMin::make(-1);
})->throws(InvalidArgumentException::class);
