<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\String;

use ExeQue\Remix\Exceptions\InvalidArgumentException;
use ExeQue\Remix\Mutate\String\Split;

it('splits a string into an array of strings', function () {
    $mutator = Split::make(3);

    expect($mutator->mutate('foo'))->toBe(['foo']);
})->with([
    [
        'length'   => 4,
        'input'    => 'foobarbaz',
        'expected' => ['foob', 'arba', 'z'],
    ],
    [
        'length'   => 2,
        'input'    => 'foobarbaz',
        'expected' => ['fo', 'ob', 'ar', 'ba', 'z'],
    ],
]);

it('throws an exception when given a negative size', function () {
    new Split(-6);
})->throws(InvalidArgumentException::class);
