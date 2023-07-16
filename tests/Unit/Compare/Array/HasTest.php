<?php

declare(strict_types=1);

namespace Tests\Unit\Compare\Array;

use ArrayIterator;
use ExeQue\Remix\Compare\Array\Has;
use ExeQue\Remix\Exceptions\InvalidArgumentException;
use stdClass;

test('checks if key exists', function (mixed $data, mixed $input, bool $expected) {
    $comparator = Has::make($input);

    expect($comparator->check($data))->toBe($expected);
})->with([
    'empty array' => [
        'data'     => [],
        'input'    => 'foo',
        'expected' => false,
    ],
    'empty iterable' => [
        'data'     => new ArrayIterator([]),
        'input'    => 'foo',
        'expected' => false,
    ],
    'non-empty array' => [
        'data'     => ['foo' => 'bar'],
        'input'    => 'foo',
        'expected' => true,
    ],
    'non-empty iterable' => [
        'data'     => new ArrayIterator(['foo' => 'bar']),
        'input'    => 'foo',
        'expected' => true,
    ],
    'non-empty map' => [
        'data'     => ['foo' => 'bar'],
        'input'    => 'foo',
        'expected' => true,
    ],
    'non-empty iterable map' => [
        'data'     => new ArrayIterator(['foo' => 'bar']),
        'input'    => 'foo',
        'expected' => true,
    ],
    'non-empty map with numeric keys' => [
        'data'     => [1 => 'foo', 2 => 'bar'],
        'input'    => 1,
        'expected' => true,
    ],
    'non-empty iterable map with numeric keys' => [
        'data'     => new ArrayIterator([1 => 'foo', 2 => 'bar']),
        'input'    => 1,
        'expected' => true,
    ],
    'non-empty map with non-existent key' => [
        'data'     => ['foo' => 'bar'],
        'input'    => 'baz',
        'expected' => false,
    ],
    'non-empty iterable map with non-existent key' => [
        'data'     => new ArrayIterator(['foo' => 'bar']),
        'input'    => 'baz',
        'expected' => false,
    ],
    'non-empty map with numeric keys and non-existent key' => [
        'data'     => [1 => 'foo', 2 => 'bar'],
        'input'    => 3,
        'expected' => false,
    ],
    'non-empty iterable map with numeric keys and non-existent key' => [
        'data'     => new ArrayIterator([1 => 'foo', 2 => 'bar']),
        'input'    => 3,
        'expected' => false,
    ],
    'non-empty map using upper-case key' => [
        'data'     => ['foo' => 'bar'],
        'input'    => 'FOO',
        'expected' => false,
    ],
    'dotted key' => [
        'data'     => ['foo' => ['bar' => 'baz']],
        'input'    => 'foo.bar',
        'expected' => true,
    ],
    'using object' => [
        'data'     => (object) ['foo' => 'bar'],
        'input'    => 'foo',
        'expected' => true,
    ],
    'star is handled as a literal' => [
        'data'     => ['*' => 'foo'],
        'input'    => '*',
        'expected' => true,
    ],
]);

it('throws an exception if input is not an array or iterable', function (mixed $input) {
    Has::make('foo')->check($input);
})->throws(InvalidArgumentException::class)->with([
    'input is a string' => [
        'input' => 'foo',
    ],
    'input is an integer' => [
        'input' => 1,
    ],
    'input is a float' => [
        'input' => 1.1,
    ],
    'input is a boolean' => [
        'input' => true,
    ],
    'input is null' => [
        'input' => null,
    ],
]);
