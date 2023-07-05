<?php

declare(strict_types=1);

namespace Tests\Unit\Compare\Countable;

use ExeQue\Remix\Compare\String\LengthBetween;
use ExeQue\Remix\Exceptions\InvalidArgumentException;

it('length is between min and max', function () {
    $comparator = LengthBetween::make(1, 3);

    expect($comparator->check('ab'))->toBe(true);
});

it('length is equal to min', function () {
    $comparator = LengthBetween::make(1, 3);

    expect($comparator->check('a'))->toBe(true);
});

it('length is equal to max', function () {
    $comparator = LengthBetween::make(1, 3);

    expect($comparator->check('abc'))->toBe(true);
});

it('length is less than min', function () {
    $comparator = LengthBetween::make(1, 3);

    expect($comparator->check(''))->toBe(false);
});

it('length is greater than max', function () {
    $comparator = LengthBetween::make(1, 3);

    expect($comparator->check('abcd'))->toBe(false);
});

it('length is equal to min when not inclusive', function () {
    $comparator = LengthBetween::make(1, 3, false);

    expect($comparator->check('a'))->toBe(false);
});

it('length is equal to max when not inclusive', function () {
    $comparator = LengthBetween::make(1, 3, false);

    expect($comparator->check('abc'))->toBe(false);
});

it('fails if given min less than zero', function () {
    LengthBetween::make(-1, 3);
})->throws(InvalidArgumentException::class);
