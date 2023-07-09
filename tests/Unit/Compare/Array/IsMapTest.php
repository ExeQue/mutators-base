<?php

declare(strict_types=1);

namespace Tests\Unit\Compare\Array;

use ArrayIterator;
use ExeQue\Remix\Compare\Array\IsMap;
use ExeQue\Remix\Exceptions\InvalidArgumentException;
use stdClass;

it('checks if a value is a map', function (mixed $input, bool $expected) {
    $comparator = IsMap::make();

    expect($comparator->check($input))->toBe($expected);
})->with([
    'empty array' => [
        'input'    => [],
        'expected' => false,
    ],
    'empty iterable' => [
        'input'    => new ArrayIterator([]),
        'expected' => false,
    ],
    'non-empty array' => [
        'input'    => [1, 2, 3],
        'expected' => false,
    ],
    'non-empty iterable' => [
        'input'    => new ArrayIterator([1, 2, 3]),
        'expected' => false,
    ],
    'non-empty map' => [
        'input'    => ['foo' => 'bar'],
        'expected' => true,
    ],
    'non-empty iterable map' => [
        'input'    => new ArrayIterator(['foo' => 'bar']),
        'expected' => true,
    ],
    'non-empty map with numeric keys' => [
        'input'    => [1 => 'foo', 2 => 'bar'],
        'expected' => true,
    ],
    'non-empty iterable map with numeric keys' => [
        'input'    => new ArrayIterator([1 => 'foo', 2 => 'bar']),
        'expected' => true,
    ],
]);

it('throws an exception if input is not an array or iterable', function (mixed $input) {
    IsMap::make()->check($input);
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
