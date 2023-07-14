<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\Array;

use ArrayIterator;
use ExeQue\Remix\Mutate\Array\Except;

it('removes specified keys from an array', function (mixed $keys, mixed $input, mixed $expected) {
    $mutator = Except::make($keys);

    expect($mutator->mutate($input))->toBe($expected);
})->with([
    'single key' => [
        'keys'     => 'foo',
        'input'    => ['foo' => 2, 'bar' => 4, 'baz' => 6],
        'expected' => ['bar' => 4, 'baz' => 6],
    ],
    'multiple keys' => [
        'keys'     => ['foo', 'bar'],
        'input'    => ['foo' => 2, 'bar' => 4, 'baz' => 6],
        'expected' => ['baz' => 6],
    ],
    'keys not found' => [
        'keys'     => ['foo', 'bar'],
        'input'    => ['baz' => 6],
        'expected' => ['baz' => 6],
    ],
    'iterator' => [
        'keys'     => ['foo', 'bar'],
        'input'    => new ArrayIterator(['foo' => 2, 'bar' => 4, 'baz' => 6]),
        'expected' => ['baz' => 6],
    ],
    'numeric keys' => [
        'keys'     => [0, 1],
        'input'    => ['foo', 'bar', 'baz'],
        'expected' => [2 => 'baz'],
    ],
]);
