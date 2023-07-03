<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\String;

use ExeQue\Remix\Exceptions\InvalidArgumentException;
use ExeQue\Remix\Mutate\String\Chunk;

test('chunks a string into an array of strings', function () {
    $mutator = Chunk::make(3);

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

test('fail on negative size', function () {
    new Chunk(-6);
})->throws(InvalidArgumentException::class);
