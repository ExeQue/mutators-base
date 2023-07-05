<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\Convert;

use ExeQue\Remix\Exceptions\InvalidArgumentException;
use ExeQue\Remix\Mutate\Convert\IntToHex;

it('converts an integer to a hex string', function () {
    $mutator = IntToHex::make();

    expect($mutator->mutate(255))->toBe('ff');
});

it('converts an integer to a hex string with padding', function () {
    $mutator = IntToHex::make(4);

    expect($mutator->mutate(255))->toBe('00ff');
});

it('fails when input is not an integer', function () {
    $mutator = IntToHex::make();

    $mutator->mutate('Hello World');
})->throws(InvalidArgumentException::class);
