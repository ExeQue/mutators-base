<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\Convert;

use ExeQue\Remix\Exceptions\InvalidArgumentException;
use ExeQue\Remix\Mutate\Convert\HexToInt;

it('converts a hex string to an integer', function () {
    $mutator = HexToInt::make();

    expect($mutator->mutate('ff'))->toBe(255);
});

it('converts a hex string to an integer with a prefix', function () {
    $mutator = HexToInt::make();

    expect($mutator->mutate('0xff'))->toBe(255);
});

it('fails when input is not a hex string', function () {
    $mutator = HexToInt::make();

    $mutator->mutate('Hello World');
})->throws(InvalidArgumentException::class);
