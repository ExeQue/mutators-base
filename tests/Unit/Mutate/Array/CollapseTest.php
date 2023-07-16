<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\Array;

use ArrayIterator;
use ExeQue\Remix\Mutate\Array\Collapse;

it('collapses array of arrays', function (mixed $input, mixed $expected) {
    $mutator = Collapse::make();

    expect($mutator->mutate($input))->toBe($expected);
})->with([
    'empty' => [
        'input'    => [],
        'expected' => [],
    ],
    'single' => [
        'input'    => [['foo' => 'bar']],
        'expected' => ['foo' => 'bar'],
    ],
    'multiple' => [
        'input'    => [['foo' => 'bar'], ['baz' => 'qux']],
        'expected' => ['foo' => 'bar', 'baz' => 'qux'],
    ],
    'multiple with duplicate keys' => [
        'input'    => [['foo' => 'bar'], ['foo' => 'baz']],
        'expected' => ['foo' => 'baz'],
    ],
    'multiple with duplicate keys and null values' => [
        'input'    => [['foo' => 'bar'], ['foo' => null]],
        'expected' => ['foo' => null],
    ],
    'skips non-array values' => [
        'input'    => [['foo' => 'bar'], 'baz'],
        'expected' => ['foo' => 'bar'],
    ],
    'uses iterable values' => [
        'input'    => [['foo' => 'bar'], new ArrayIterator(['baz' => 'qux'])],
        'expected' => ['foo' => 'bar', 'baz' => 'qux'],
    ],
]);
