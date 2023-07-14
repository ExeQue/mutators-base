<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\Array;

use ArrayIterator;
use ExeQue\Remix\Exceptions\InvalidArgumentException;
use ExeQue\Remix\Mutate\Array\Only;

it('gets only the specified keys from an array', function (mixed $keys, mixed $input, mixed $expected) {
    $mutator = Only::make($keys);

    expect($mutator->mutate($input))->toBe($expected);
})->with([
    'single key' => [
        'keys'     => 'foo',
        'input'    => ['foo' => 2, 'bar' => 4, 'baz' => 6],
        'expected' => ['foo' => 2],
    ],
    'multiple keys' => [
        'keys'     => ['foo', 'bar'],
        'input'    => ['foo' => 2, 'bar' => 4, 'baz' => 6],
        'expected' => ['foo' => 2, 'bar' => 4],
    ],
    'keys not found' => [
        'keys'     => ['foo', 'bar'],
        'input'    => ['baz' => 6],
        'expected' => [],
    ],
    'iterator' => [
        'keys'     => ['foo', 'bar'],
        'input'    => new ArrayIterator(['foo' => 2, 'bar' => 4, 'baz' => 6]),
        'expected' => ['foo' => 2, 'bar' => 4],
    ],
    'numeric keys' => [
        'keys'     => [1, 2],
        'input'    => ['foo', 'bar', 'baz'],
        'expected' => [1 => 'bar', 2 => 'baz'],
    ],
]);

it('throws an exception if given a non-iterable input', function () {
    $mutator = Only::make('foo');

    $mutator->mutate('foo');
})->throws(InvalidArgumentException::class);
