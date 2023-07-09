<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\Array;

use ArrayIterator;
use ExeQue\Remix\Exceptions\InvalidArgumentException;
use ExeQue\Remix\Mutate\Array\At;
use stdClass;

it('gets the element at a given index', function (mixed $index, mixed $input, mixed $expected) {
    $mutator = At::make($index);

    expect($mutator->mutate($input))->toBe($expected);
})->with(function () {
    return [
        'list' => [
            'index'    => 1,
            'input'    => ['foo', 'bar', 'baz'],
            'expected' => 'bar',
        ],
        'list out of bounds' => [
            'index'    => 3,
            'input'    => ['foo', 'bar', 'baz'],
            'expected' => null,
        ],
        'list in reverse' => [
            'index'    => -1,
            'input'    => ['foo', 'bar', 'baz'],
            'expected' => 'baz',
        ],
        'list in reverse out of bounds' => [
            'index'    => -4,
            'input'    => ['foo', 'bar', 'baz'],
            'expected' => null,
        ],
        'list not an integer' => [
            'index'    => 'foo',
            'input'    => ['foo', 'bar', 'baz'],
            'expected' => null,
        ],
        'map' => [
            'index'    => 'foo',
            'input'    => ['foo' => 'bar', 'baz' => 'qux'],
            'expected' => 'bar',
        ],
        'map not found' => [
            'index'    => 'qux',
            'input'    => ['foo' => 'bar', 'baz' => 'qux'],
            'expected' => null,
        ],
        'map not a string' => [
            'index'    => 0,
            'input'    => ['foo' => 'bar', 'baz' => 'qux'],
            'expected' => null,
        ],
        'iterator' => [
            'index'    => 1,
            'input'    => new ArrayIterator(['foo', 'bar', 'baz']),
            'expected' => 'bar',
        ],
    ];
});

it('has set default value when the index does not exist', function (mixed $default, mixed $expected) {
    $mutator = At::make('qux', $default);

    expect($mutator->mutate(['foo' => 'bar', 'baz' => 'qux']))->toBe($expected);
})->with([
    'default value' => [
        'default'  => 'foo',
        'expected' => 'foo',
    ],
    'default value from callable' => [
        'default'  => fn () => 'foo',
        'expected' => 'foo',
    ],
]);

it('throws an exception given a non-iterable input', function (mixed $input) {
    At::make(1)->mutate($input);
})->throws(InvalidArgumentException::class)->with([
    'string' => [
        'input' => 'foo',
    ],
    'int' => [
        'input' => 1,
    ],
    'float' => [
        'input' => 1.1,
    ],
    'bool' => [
        'input' => true,
    ],
    'scalar' => [
        'input' => 'foo',
    ],
    'numeric' => [
        'input' => '1.3',
    ],
    'object' => [
        'input' => new stdClass(),
    ],
    'null' => [
        'input' => null,
    ],
]);
