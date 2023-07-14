<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\Array;

use ArrayIterator;
use ExeQue\Remix\Exceptions\InvalidArgumentException;
use ExeQue\Remix\Mutate\Array\Implode;

it('implodes an array', function (string $glue, mixed $finalGlue, mixed $input, mixed $expected) {
    $mutator = Implode::make($glue, $finalGlue);

    expect($mutator->mutate($input))->toBe($expected);
})->with([
    'glue only' => [
        'glue'      => ', ',
        'finalGlue' => null,
        'input'     => ['foo', 'bar', 'baz'],
        'expected'  => 'foo, bar, baz',
    ],
    'glue and final glue' => [
        'glue'      => ', ',
        'finalGlue' => ' and ',
        'input'     => ['foo', 'bar', 'baz'],
        'expected'  => 'foo, bar and baz',
    ],
    'iterator' => [
        'glue'      => ', ',
        'finalGlue' => ' and ',
        'input'     => new ArrayIterator(['foo', 'bar', 'baz']),
        'expected'  => 'foo, bar and baz',
    ],
    'empty array' => [
        'glue'      => ', ',
        'finalGlue' => ' and ',
        'input'     => [],
        'expected'  => '',
    ],
    'single element array' => [
        'glue'      => ', ',
        'finalGlue' => ' and ',
        'input'     => ['foo'],
        'expected'  => 'foo',
    ],
    'iterable' => [
        'glue'      => ', ',
        'finalGlue' => ' and ',
        'input'     => new ArrayIterator(['foo', 'bar', 'baz']),
        'expected'  => 'foo, bar and baz',
    ],
]);

it('throws an exception of given a non-iterable input', function () {
    $mutator = Implode::make(', ');

    $mutator->mutate('foo');
})->throws(InvalidArgumentException::class);
