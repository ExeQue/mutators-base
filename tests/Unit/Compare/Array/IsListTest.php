<?php

declare(strict_types=1);

namespace Tests\Unit\Compare\Array;

use ArrayIterator;
use ExeQue\Remix\Compare\Array\IsList;
use ExeQue\Remix\Exceptions\InvalidArgumentException;
use stdClass;

it('checks if a value is a list', function (mixed $input, bool $expected) {
    $comparator = IsList::make();

    expect($comparator->check($input))->toBe($expected);
})->with([
    'empty array' => [
        'input'    => [],
        'expected' => true,
    ],
    'empty iterable' => [
        'input'    => new ArrayIterator([]),
        'expected' => true,
    ],
    'non-empty array' => [
        'input'    => [1, 2, 3],
        'expected' => true,
    ],
    'non-empty iterable' => [
        'input'    => new ArrayIterator([1, 2, 3]),
        'expected' => true,
    ],
    'non-empty map' => [
        'input'    => ['foo' => 'bar'],
        'expected' => false,
    ],
    'non-empty iterable map' => [
        'input'    => new ArrayIterator(['foo' => 'bar']),
        'expected' => false,
    ],
    'non-empty map with numeric keys' => [
        'input'    => [1 => 'foo', 2 => 'bar'],
        'expected' => false,
    ],
    'non-empty iterable map with numeric keys' => [
        'input'    => new ArrayIterator([1 => 'foo', 2 => 'bar']),
        'expected' => false,
    ],
]);

it('throws an exception if input is not an array or iterable', function (mixed $input) {
    IsList::make()->check($input);
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
