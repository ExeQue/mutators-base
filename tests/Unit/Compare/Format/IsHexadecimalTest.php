<?php

declare(strict_types=1);

namespace Tests\Unit\Compare\Format;

use ExeQue\Remix\Compare\Format\IsHexadecimal;

it('checks if a string is hexadecimal', function () {
    $comparator = IsHexadecimal::make();

    expect($comparator->check('ff'))->toBe(true);
});

it('checks if a string is not hexadecimal', function () {
    $comparator = IsHexadecimal::make();

    expect($comparator->check('Hello World'))->toBe(false);
});

it('checks if a string is not hexadecimal with a prefix', function () {
    $comparator = IsHexadecimal::make();

    expect($comparator->check('0xff'))->toBe(true);
});

it('checks if a string is a hexadecimal bytes with spaces', function () {
    $comparator = IsHexadecimal::make(true);

    expect($comparator->check('ff ff'))->toBe(true);
});
