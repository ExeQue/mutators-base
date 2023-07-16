<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\Array;

use ArrayIterator;
use ArrayObject;
use ExeQue\Remix\Mutate\Array\Get;

it('gets from input', function (mixed $key, mixed $default, mixed $input, mixed $expected) {
    $mutator = Get::make($key, $default);

    expect($mutator->mutate($input))->toBe($expected)
        ->and($mutator->mutate(new ArrayObject($input)))->toBe($expected)
        ->and($mutator->mutate(new ArrayIterator($input)))->toBe($expected);
})->with([
    'empty' => [
        'key'      => 'foo',
        'default'  => null,
        'input'    => [],
        'expected' => null,
    ],
    'simple key' => [
        'key'      => 'foo',
        'default'  => null,
        'input'    => ['foo' => 'bar'],
        'expected' => 'bar',
    ],
    'simple key with numeric keys' => [
        'key'      => 1,
        'default'  => null,
        'input'    => [1 => 'foo', 2 => 'bar'],
        'expected' => 'foo',
    ],
    'simple key with non-existent key' => [
        'key'      => 'baz',
        'default'  => null,
        'input'    => ['foo' => 'bar'],
        'expected' => null,
    ],
    'simple key with non-existent numeric key' => [
        'key'      => 3,
        'default'  => null,
        'input'    => [1 => 'foo', 2 => 'bar'],
        'expected' => null,
    ],
    'simple key with non-existent key and default' => [
        'key'      => 'baz',
        'default'  => 'qux',
        'input'    => ['foo' => 'bar'],
        'expected' => 'qux',
    ],
    'dotted key' => [
        'key'      => 'foo.bar',
        'default'  => null,
        'input'    => ['foo' => ['bar' => 'baz']],
        'expected' => 'baz',
    ],
    'dotted non-existent key' => [
        'key'      => 'foo.baz',
        'default'  => null,
        'input'    => ['foo' => ['bar' => 'baz']],
        'expected' => null,
    ],
    'dotted non-existent key with default' => [
        'key'      => 'foo.baz',
        'default'  => 'qux',
        'input'    => ['foo' => ['bar' => 'baz']],
        'expected' => 'qux',
    ],
    'dotted key with star' => [
        'key'      => 'foo.*',
        'default'  => null,
        'input'    => ['foo' => [['baz' => 'bar'], ['baz' => 'baz']]],
        'expected' => [['baz' => 'bar'], ['baz' => 'baz']],
    ],
    'dotted key with star and sub key' => [
        'key'      => 'foo.*.baz',
        'default'  => null,
        'input'    => ['foo' => [['baz' => 'bar'], ['baz' => 'baz']]],
        'expected' => ['bar', 'baz'],
    ],
    'dotted key with star and non-existent sub key' => [
        'key'      => 'foo.*.qux',
        'default'  => null,
        'input'    => ['foo' => [['baz' => 'bar'], ['baz' => 'baz']]],
        'expected' => [null, null],
    ],
    'array key' => [
        'key'      => ['foo', 'bar'],
        'default'  => null,
        'input'    => ['foo' => ['bar' => 'baz']],
        'expected' => 'baz',
    ],
    'array key with non-existent key' => [
        'key'      => ['foo', 'baz'],
        'default'  => null,
        'input'    => ['foo' => ['bar' => 'baz']],
        'expected' => null,
    ],
    'array key with non-existent key and default' => [
        'key'      => ['foo', 'baz'],
        'default'  => 'qux',
        'input'    => ['foo' => ['bar' => 'baz']],
        'expected' => 'qux',
    ],
    'array key with star' => [
        'key'      => ['foo', '*'],
        'default'  => null,
        'input'    => ['foo' => [['baz' => 'bar'], ['baz' => 'baz']]],
        'expected' => [['baz' => 'bar'], ['baz' => 'baz']],
    ],
    'array key with star and sub key' => [
        'key'      => ['foo', '*', 'baz'],
        'default'  => null,
        'input'    => ['foo' => [['baz' => 'bar'], ['baz' => 'baz']]],
        'expected' => ['bar', 'baz'],
    ],
    'array key with star and non-existent sub key' => [
        'key'      => ['foo', '*', 'qux'],
        'default'  => null,
        'input'    => ['foo' => [['baz' => 'bar'], ['baz' => 'baz']]],
        'expected' => [null, null],
    ],
    'array key with star and non-existent sub key and default' => [
        'key'      => ['foo', '*', 'qux'],
        'default'  => 'quux',
        'input'    => ['foo' => [['baz' => 'bar'], ['baz' => 'baz']]],
        'expected' => ['quux', 'quux'],
    ],
    'array key with null' => [
        'key'      => ['foo', null],
        'default'  => null,
        'input'    => ['foo' => ['bar' => 'baz']],
        'expected' => ['bar' => 'baz'],
    ],
    'uses default if star is not iterable' => [
        'key'      => ['foo', '*', 'baz'],
        'default'  => null,
        'input'    => ['foo' => 'bar'],
        'expected' => null,
    ],
    'uses object input' => [
        'key'      => 'foo',
        'default'  => null,
        'input'    => (object)['foo' => 'bar'],
        'expected' => 'bar',
    ],
    'uses callable default' => [
        'key'      => 'foo',
        'default'  => static fn () => 'bar',
        'input'    => [],
        'expected' => 'bar',
    ],
]);
