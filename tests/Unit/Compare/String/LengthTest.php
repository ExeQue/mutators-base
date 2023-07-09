<?php

declare(strict_types=1);

namespace Tests\Unit\Compare\String;

// Create tests similar to CountTest.php but for LengthTest.php

use ExeQue\Remix\Compare\String\Length;

it('checks if the length of the string is equal to the expected length', function (int $length, string $input, bool $expected) {
    $comparator = Length::equal($length);

    expect($comparator->check($input))->toBe($expected);
})->with(function () {
    return [
        'equal' => [
            'length'   => 3,
            'input'    => 'foo',
            'expected' => true,
        ],
        'not equal' => [
            'length'   => 4,
            'input'    => 'foo',
            'expected' => false,
        ],
    ];
});

it('checks if the length is minimum to the expected length', function (int $length, bool $inclusive, string $input, bool $expected) {
    $comparator = Length::min($length, $inclusive);

    expect($comparator->check($input))->toBe($expected);
})->with(
    [
        'three with three' => [
            'length'    => 3,
            'inclusive' => false,
            'input'     => 'foo',
            'expected'  => false,
        ],
        'three with three inclusive' => [
            'length'    => 3,
            'inclusive' => true,
            'input'     => 'foo',
            'expected'  => true,
        ],
        'three with six' => [
            'length'    => 3,
            'inclusive' => false,
            'input'     => 'foobar',
            'expected'  => true,
        ],
        'three with two' => [
            'length'    => 3,
            'inclusive' => false,
            'input'     => 'fo',
            'expected'  => false,
        ],
    ]
);

it('checks if the length is maximum to the expected length', function (int $length, bool $inclusive, string $input, bool $expected) {
    $comparator = Length::max($length, $inclusive);

    expect($comparator->check($input))->toBe($expected);
})->with(
    [
        'three with three' => [
            'length'    => 3,
            'inclusive' => false,
            'input'     => 'foo',
            'expected'  => false,
        ],
        'three with three inclusive' => [
            'length'    => 3,
            'inclusive' => true,
            'input'     => 'foo',
            'expected'  => true,
        ],
        'three with six' => [
            'length'    => 3,
            'inclusive' => false,
            'input'     => 'foobar',
            'expected'  => false,
        ],
        'three with two' => [
            'length'    => 3,
            'inclusive' => false,
            'input'     => 'fo',
            'expected'  => true,
        ],
    ]
);

it('checks if the length is between the expected length', function (int $min, int $max, bool $inclusive, string $input, bool $expected) {
    $comparator = Length::between($min, $max, $inclusive);

    expect($comparator->check($input))->toBe($expected);
})->with(
    [
        'one to three with one' => [
            'min'       => 1,
            'max'       => 3,
            'inclusive' => false,
            'input'     => 'f',
            'expected'  => false,
        ],
        'one to three with one inclusive' => [
            'min'       => 1,
            'max'       => 3,
            'inclusive' => true,
            'input'     => 'f',
            'expected'  => true,
        ],
        'one to three with two' => [
            'min'       => 1,
            'max'       => 3,
            'inclusive' => false,
            'input'     => 'fo',
            'expected'  => true,
        ],
        'one to three with three' => [
            'min'       => 1,
            'max'       => 3,
            'inclusive' => false,
            'input'     => 'foo',
            'expected'  => false,
        ],
        'one to three with three inclusive' => [
            'min'       => 1,
            'max'       => 3,
            'inclusive' => true,
            'input'     => 'foo',
            'expected'  => true,
        ],
        'one to three with six' => [
            'min'       => 1,
            'max'       => 3,
            'inclusive' => false,
            'input'     => 'foobar',
            'expected'  => false,
        ],

    ]
);
