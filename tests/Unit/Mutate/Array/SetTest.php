<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\Array;

use ExeQue\Remix\Mutate\Array\Set;

it('sets value on input', function (mixed $key, mixed $value, bool $overwrite, mixed $input, mixed $expected) {
    $mutator = Set::make($key, $value, $overwrite);

    expect($mutator->mutate($input))->toBe($expected);
})->with(function () {
    return [
        'empty' => [
            'key'       => 'foo',
            'value'     => 'bar',
            'overwrite' => true,
            'input'     => [],
            'expected'  => ['foo' => 'bar'],
        ],
        'simple key' => [
            'key'       => 'foo',
            'value'     => 'bar',
            'overwrite' => true,
            'input'     => ['foo' => 'baz'],
            'expected'  => ['foo' => 'bar'],
        ],
        'simple key with numeric keys' => [
            'key'       => 1,
            'value'     => 'bar',
            'overwrite' => true,
            'input'     => [1 => 'foo', 2 => 'baz'],
            'expected'  => [1 => 'bar', 2 => 'baz'],
        ],
        'simple key with non-existent key' => [
            'key'       => 'foo',
            'value'     => 'bar',
            'overwrite' => true,
            'input'     => ['baz' => 'qux'],
            'expected'  => ['baz' => 'qux', 'foo' => 'bar'],
        ],
        'simple key with non-existent numeric key' => [
            'key'       => 3,
            'value'     => 'bar',
            'overwrite' => true,
            'input'     => [1 => 'foo', 2 => 'baz'],
            'expected'  => [1 => 'foo', 2 => 'baz', 3 => 'bar'],
        ],
        'simple key with non-existent key and overwrite false' => [
            'key'       => 'foo',
            'value'     => 'bar',
            'overwrite' => false,
            'input'     => ['baz' => 'qux'],
            'expected'  => ['baz' => 'qux', 'foo' => 'bar'],
        ],
        'simple key with non-existent numeric key and overwrite false' => [
            'key'       => 3,
            'value'     => 'bar',
            'overwrite' => false,
            'input'     => [1 => 'foo', 2 => 'baz'],
            'expected'  => [1 => 'foo', 2 => 'baz', 3 => 'bar'],
        ],
        'dotted key' => [
            'key'       => 'foo.bar',
            'value'     => 'baz',
            'overwrite' => true,
            'input'     => ['foo' => ['bar' => 'qux']],
            'expected'  => ['foo' => ['bar' => 'baz']],
        ],
        'dotted non-existent key' => [
            'key'       => 'foo.bar',
            'value'     => 'baz',
            'overwrite' => true,
            'input'     => ['foo' => ['qux' => 'quux']],
            'expected'  => ['foo' => ['qux' => 'quux', 'bar' => 'baz']],
        ],
        'dotted non-existent key and overwrite false' => [
            'key'       => 'foo.bar',
            'value'     => 'baz',
            'overwrite' => false,
            'input'     => ['foo' => ['qux' => 'quux']],
            'expected'  => ['foo' => ['qux' => 'quux', 'bar' => 'baz']],
        ],
        'dotted key with star' => [
            'key'       => 'foo.*',
            'value'     => 'bar',
            'overwrite' => true,
            'input'     => ['foo' => ['baz' => 'qux']],
            'expected'  => ['foo' => ['baz' => 'bar']],
        ],
        'dotted key with star and overwrite false' => [
            'key'       => 'foo.*',
            'value'     => 'bar',
            'overwrite' => false,
            'input'     => ['foo' => ['baz' => 'qux', 'bar' => null]],
            'expected'  => ['foo' => ['baz' => 'qux', 'bar' => null]],
        ],
        'dotted key with star and list input' => [
            'key'       => 'foo.*',
            'value'     => 'bar',
            'overwrite' => true,
            'input'     => ['foo' => ['baz', 'qux']],
            'expected'  => ['foo' => ['bar', 'bar']],
        ],
        'dotted key with star and sub-key' => [
            'key'       => 'foo.*.bar',
            'value'     => 'baz',
            'overwrite' => true,
            'input'     => ['foo' => [['bar' => 'qux'], ['bar' => 'quux']]],
            'expected'  => ['foo' => [['bar' => 'baz'], ['bar' => 'baz']]],
        ],
        'non-existent key' => [
            'key'       => 'bar.qux',
            'value'     => 'baz',
            'overwrite' => true,
            'input'     => ['foo' => 'bar'],
            'expected'  => ['foo' => 'bar', 'bar' => ['qux' => 'baz']],
        ],
        'object input' => [
            'key'       => 'foo',
            'value'     => 'bar',
            'overwrite' => true,
            'input'     => $objectInput = (object)['foo' => 'baz'],
            'expected'  => $objectInput,
        ],
        'object input with non-existent key' => [
            'key'       => 'bar.qux',
            'value'     => 'baz',
            'overwrite' => true,
            'input'     => $objectNonExistent = (object)['foo' => 'bar'],
            'expected'  => $objectNonExistent,
        ],
        'input not accessible' => [
            'key'       => 'foo.*.bar',
            'value'     => 'baz',
            'overwrite' => true,
            'input'     => null,
            'expected'  => ['foo' => []],
        ],
        'string input' => [
            'key'       => 'foo',
            'value'     => 'bar',
            'overwrite' => true,
            'input'     => 'baz',
            'expected'  => ['foo' => 'bar'],
        ],
    ];
});
