<?php

declare(strict_types=1);

namespace Tests\Unit\Compare\Countable;

use ExeQue\Remix\Compare\String\LengthEqual;
use ExeQue\Remix\Exceptions\InvalidArgumentException;

test('checks length is equal', function () {
    $comparator = LengthEqual::make(3);

    expect($comparator->check('abc'))->toBe(true);
});

test('checks length is not equal', function () {
    $comparator = LengthEqual::make(3);

    expect($comparator->check('abcd'))->toBe(false);
});

test('fails if length is negative', function () {
    LengthEqual::make(-1);
})->throws(InvalidArgumentException::class);
