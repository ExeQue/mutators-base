<?php

declare(strict_types=1);

namespace Tests\Unit\Compare\Countable;

use ExeQue\Remix\Compare\String\LengthMin;
use ExeQue\Remix\Exceptions\InvalidArgumentException;

it('length is greater than minimum', function () {
    $comparator = LengthMin::make(2);

    expect($comparator->check('abc'))->toBe(true);
});

it('length is equal to minimum', function () {
    $comparator = LengthMin::make(2);

    expect($comparator->check('ab'))->toBe(true);
});

it('length is less than minimum', function () {
    $comparator = LengthMin::make(2);

    expect($comparator->check('a'))->toBe(false);
});

it('length is equal to minimum when not inclusive', function () {
    $comparator = LengthMin::make(2, false);

    expect($comparator->check('ab'))->toBe(false);
});

it('fails if given minimum less than zero', function () {
    LengthMin::make(-1);
})->throws(InvalidArgumentException::class);
