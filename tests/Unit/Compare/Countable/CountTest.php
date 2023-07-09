<?php

declare(strict_types=1);

namespace Tests\Unit\Compare\Countable;

use ArrayIterator;
use Countable;
use ExeQue\Remix\Compare\Countable\Count;
use ExeQue\Remix\Exceptions\InvalidArgumentException;

it('checks if the count is equal to the input size', function (int $size, mixed $input, bool $expected) {
    $comparator = Count::equal($size);

    expect($comparator->check($input))->toBe($expected);
})->with([
    'three with three' => [
        'size'     => 3,
        'input'    => [1, 2, 3],
        'expected' => true,
    ],
    'three with two' => [
        'size'     => 3,
        'input'    => [1, 2],
        'expected' => false,
    ],
]);

it('checks if the count is minimum to the input size', function (int $size, bool $inclusive, mixed $input, bool $expected) {
    $comparator = Count::min($size, $inclusive);

    expect($comparator->check($input))->toBe($expected);
})->with(
    [
        'three with three' => [
            'size'      => 3,
            'inclusive' => false,
            'input'     => [1, 2, 3],
            'expected'  => false,
        ],
        'three with three inclusive' => [
            'size'      => 3,
            'inclusive' => true,
            'input'     => [1, 2, 3],
            'expected'  => true,
        ],
        'three with four' => [
            'size'      => 3,
            'inclusive' => false,
            'input'     => [1, 2, 3, 4],
            'expected'  => true,
        ],
        'three with two' => [
            'size'      => 3,
            'inclusive' => false,
            'input'     => [1, 2],
            'expected'  => false,
        ],
    ]
);

it('checks if the count is maximum to the input size', function (int $size, bool $inclusive, mixed $input, bool $expected) {
    $comparator = Count::max($size, $inclusive);

    expect($comparator->check($input))->toBe($expected);
})->with(
    [
        'three with three' => [
            'size'      => 3,
            'inclusive' => false,
            'input'     => [1, 2, 3],
            'expected'  => false,
        ],
        'three with three inclusive' => [
            'size'      => 3,
            'inclusive' => true,
            'input'     => [1, 2, 3],
            'expected'  => true,
        ],
        'three with four' => [
            'size'      => 3,
            'inclusive' => false,
            'input'     => [1, 2, 3, 4],
            'expected'  => false,
        ],
        'three with two' => [
            'size'      => 3,
            'inclusive' => false,
            'input'     => [1, 2],
            'expected'  => true,
        ],
    ]
);

it('checks if the count is between the input size', function (int $min, int $max, bool $inclusive, mixed $input, bool $expected) {
    $comparator = Count::between($min, $max, $inclusive);

    expect($comparator->check($input))->toBe($expected);
})->with(
    [
        'one to three with one' => [
            'min'       => 1,
            'max'       => 3,
            'inclusive' => false,
            'input'     => [1],
            'expected'  => false,
        ],
        'one to three with one inclusive' => [
            'min'       => 1,
            'max'       => 3,
            'inclusive' => true,
            'input'     => [1],
            'expected'  => true,
        ],
        'one to three with two' => [
            'min'       => 1,
            'max'       => 3,
            'inclusive' => false,
            'input'     => [1, 2],
            'expected'  => true,
        ],
        'one to three with three' => [
            'min'       => 1,
            'max'       => 3,
            'inclusive' => false,
            'input'     => [1, 2, 3],
            'expected'  => false,
        ],
        'one to three with three inclusive' => [
            'min'       => 1,
            'max'       => 3,
            'inclusive' => true,
            'input'     => [1, 2, 3],
            'expected'  => true,
        ],
        'one to three with four' => [
            'min'       => 1,
            'max'       => 3,
            'inclusive' => false,
            'input'     => [1, 2, 3, 4],
            'expected'  => false,
        ],
    ]
);

it('supports countable types', function (mixed $input) {
    $comparator = Count::equal(3);

    $comparator->check($input);
})->throwsNoExceptions()->with([
    'array' => [
        'input' => [1, 2, 3],
    ],
    'iterable' => [
        'input' => new ArrayIterator([1, 2, 3]),
    ],
    'countable object' => [
        'input' => new class implements Countable
        {
            public function count(): int
            {
                return 3;
            }
        },
    ],
    'object with count method' => [
        'input' => new class
        {
            public function count(): int
            {
                return 3;
            }
        },
    ],
]);

it('throws an exception if the input is not countable', function () {
    $comparator = Count::equal(3);

    $comparator->check('not countable');
})->throws(InvalidArgumentException::class);

it('throws an exception if both min and max are null', function () {
    Count::make(null, null);
})->throws(InvalidArgumentException::class);

it('throws an exception if min or max are invalid', function (int $min, int $max) {
    Count::make($min, $max);
})->throws(InvalidArgumentException::class)->with([
    'min is negative' => [
        'min' => -1,
        'max' => 10,
    ],
    'max is negative' => [
        'min' => -10,
        'max' => -1,
    ],
    'min is greater than max' => [
        'min' => 2,
        'max' => 1,
    ],
]);
