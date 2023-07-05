<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\Convert;

use ExeQue\Remix\Exceptions\InvalidArgumentException;
use ExeQue\Remix\Mutate\Convert\HexToBin;

it('converts hex to binary', function () {
    $mutator = HexToBin::make();

    expect($mutator->mutate('48656c6c6f20576f726c64'))->toBe('Hello World');
});

it('converts hex to binary with spaces', function () {
    $mutator = HexToBin::make();

    expect($mutator->mutate('48 65 6c 6c 6f 20 57 6f 72 6c 64'))->toBe('Hello World');
});

it('fails when input is not a hex string', function () {
    $mutator = HexToBin::make();

    $mutator->mutate('Hello World');
})->throws(InvalidArgumentException::class);

it('fails if the input is not even length', function () {
    $mutator = HexToBin::make();

    $mutator->mutate('48656c6c6f20576f726c6');
})->throws(InvalidArgumentException::class);
