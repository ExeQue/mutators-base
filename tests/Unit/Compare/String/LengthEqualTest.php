<?php

declare(strict_types=1);

namespace Tests\Unit\Compare\Countable;

use ExeQue\Remix\Compare\String\LengthEqual;
use ExeQue\Remix\Exceptions\InvalidArgumentException;

it('checks length is equal', function () {
    $comparator = LengthEqual::make(3);

    expect($comparator->check('abc'))->toBe(true);
});

it('checks length is not equal', function () {
    $comparator = LengthEqual::make(3);

    expect($comparator->check('abcd'))->toBe(false);
});

it('fails if length is negative', function () {
    LengthEqual::make(-1);
})->throws(InvalidArgumentException::class);
