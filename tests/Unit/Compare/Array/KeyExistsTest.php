<?php

declare(strict_types=1);

namespace Tests\Unit\Compare\Array;

// Create tests for the following class: \ExeQue\Remix\Compare\Array\KeyExists

use ArrayIterator;
use ExeQue\Remix\Compare\Array\KeyExists;
use ExeQue\Remix\Exceptions\InvalidArgumentException;
use stdClass;

test('checks if key exists', function (mixed $data, mixed $input, bool $expected) {
    $comparator = KeyExists::make($input);

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
]);

it('throws an exception if input is not an array or iterable', function (mixed $input) {
    KeyExists::make('foo')->check($input);
})->throws(InvalidArgumentException::class)->with([
    'input is a string' => [
        'input' => 'foo',
    ],
    'input is an object' => [
        'input' => new stdClass(),
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
