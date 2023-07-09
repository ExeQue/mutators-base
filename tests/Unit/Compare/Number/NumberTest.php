<?php

declare(strict_types=1);

namespace Tests\Unit\Compare\Number;

use ExeQue\Remix\Compare\Number\Number;

it('checks if number is equal to input', function (mixed $number, mixed $input, bool $expected) {
    $comparator = Number::equal($number);

    expect($comparator->check($input))->toBe($expected);
})->with([
    'integer' => [
        'number'   => 1,
        'input'    => 1,
        'expected' => true,
    ],
    'float' => [
        'number'   => 1.0,
        'input'    => 1.0,
        'expected' => true,
    ],
    'integer with float' => [
        'number'   => 1,
        'input'    => 1.0,
        'expected' => true,
    ],
    'float with integer' => [
        'number'   => 1.0,
        'input'    => 1,
        'expected' => true,
    ],
    'integer with string' => [
        'number'   => 1,
        'input'    => '1',
        'expected' => true,
    ],
    'float with string' => [
        'number'   => 1.0,
        'input'    => '1.0',
        'expected' => true,
    ],
]);

it('checks if number is greater than input', function (mixed $min, bool $inclusive, mixed $input, bool $expected) {
    $comparator = Number::min($min, $inclusive);

    expect($comparator->check($input))->toBe($expected);
})->with([
    'integer' => [
        'number'    => 1,
        'inclusive' => false,
        'input'     => 2,
        'expected'  => true,
    ],
    'float' => [
        'number'    => 1.0,
        'inclusive' => false,
        'input'     => 2.0,
        'expected'  => true,
    ],
    'integer with float' => [
        'number'    => 1,
        'inclusive' => false,
        'input'     => 2.0,
        'expected'  => true,
    ],
    'float with integer' => [
        'number'    => 1.0,
        'inclusive' => false,
        'input'     => 2,
        'expected'  => true,
    ],
    'integer with string' => [
        'number'    => 1,
        'inclusive' => false,
        'input'     => '2',
        'expected'  => true,
    ],
    'float with string' => [
        'number'    => 1.0,
        'inclusive' => false,
        'input'     => '2.0',
        'expected'  => true,
    ],
    'integer with integer inclusive' => [
        'number'    => 1,
        'inclusive' => true,
        'input'     => 1,
        'expected'  => true,
    ],
    'float with float inclusive' => [
        'number'    => 1.0,
        'inclusive' => true,
        'input'     => 1.0,
        'expected'  => true,
    ],
    'integer with float inclusive' => [
        'number'    => 1,
        'inclusive' => true,
        'input'     => 1.0,
        'expected'  => true,
    ],
    'float with integer inclusive' => [
        'number'    => 1.0,
        'inclusive' => true,
        'input'     => 1,
        'expected'  => true,
    ],
    'integer with string inclusive' => [
        'number'    => 1,
        'inclusive' => true,
        'input'     => '1',
        'expected'  => true,
    ],
    'float with string inclusive' => [
        'number'    => 1.0,
        'inclusive' => true,
        'input'     => '1.0',
        'expected'  => true,
    ],
]);

it('checks if number is less than input', function (mixed $max, bool $inclusive, mixed $input, bool $expected) {
    $comparator = Number::max($max, $inclusive);

    expect($comparator->check($input))->toBe($expected);
})->with([
    'integer' => [
        'number'    => 2,
        'inclusive' => false,
        'input'     => 1,
        'expected'  => true,
    ],
    'float' => [
        'number'    => 2.0,
        'inclusive' => false,
        'input'     => 1.0,
        'expected'  => true,
    ],
    'integer with float' => [
        'number'    => 2,
        'inclusive' => false,
        'input'     => 1.0,
        'expected'  => true,
    ],
    'float with integer' => [
        'number'    => 2.0,
        'inclusive' => false,
        'input'     => 1,
        'expected'  => true,
    ],
    'integer with string' => [
        'number'    => 2,
        'inclusive' => false,
        'input'     => '1',
        'expected'  => true,
    ],
    'float with string' => [
        'number'    => 2.0,
        'inclusive' => false,
        'input'     => '1.0',
        'expected'  => true,
    ],
    'integer with integer inclusive' => [
        'number'    => 1,
        'inclusive' => true,
        'input'     => 1,
        'expected'  => true,
    ],
    'float with float inclusive' => [
        'number'    => 1.0,
        'inclusive' => true,
        'input'     => 1.0,
        'expected'  => true,
    ],
    'integer with float inclusive' => [
        'number'    => 1,
        'inclusive' => true,
        'input'     => 1.0,
        'expected'  => true,
    ],
    'float with integer inclusive' => [
        'number'    => 1.0,
        'inclusive' => true,
        'input'     => 1,
        'expected'  => true,
    ],
    'integer with string inclusive' => [
        'number'    => 1,
        'inclusive' => true,
        'input'     => '1',
        'expected'  => true,
    ],
    'float with string inclusive' => [
        'number'    => 1.0,
        'inclusive' => true,
        'input'     => '1.0',
        'expected'  => true,
    ],
]);

it('checks if number is between input', function (mixed $min, mixed $max, bool $inclusive, mixed $input, bool $expected) {
    $comparator = Number::between($min, $max, $inclusive);

    expect($comparator->check($input))->toBe($expected);
})->with([
    'integer' => [
        'min'       => 1,
        'max'       => 3,
        'inclusive' => false,
        'input'     => 2,
        'expected'  => true,
    ],
    'float' => [
        'min'       => 1.0,
        'max'       => 3.0,
        'inclusive' => false,
        'input'     => 2.0,
        'expected'  => true,
    ],
    'integer with float' => [
        'min'       => 1,
        'max'       => 3,
        'inclusive' => false,
        'input'     => 2.0,
        'expected'  => true,
    ],
    'float with integer' => [
        'min'       => 1.0,
        'max'       => 3.0,
        'inclusive' => false,
        'input'     => 2,
        'expected'  => true,
    ],
    'integer with string' => [
        'min'       => 1,
        'max'       => 3,
        'inclusive' => false,
        'input'     => '2',
        'expected'  => true,
    ],
    'float with string' => [
        'min'       => 1.0,
        'max'       => 3.0,
        'inclusive' => false,
        'input'     => '2.0',
        'expected'  => true,
    ],
    'integer with integer inclusive' => [
        'min'       => 1,
        'max'       => 3,
        'inclusive' => true,
        'input'     => 1,
        'expected'  => true,
    ],
    'float with float inclusive' => [
        'min'       => 1.0,
        'max'       => 3.0,
        'inclusive' => true,
        'input'     => 1.0,
        'expected'  => true,
    ],
    'integer with float inclusive' => [
        'min'       => 1,
        'max'       => 3,
        'inclusive' => true,
        'input'     => 1.0,
        'expected'  => true,
    ],
    'float with integer inclusive' => [
        'min'       => 1.0,
        'max'       => 3.0,
        'inclusive' => true,
        'input'     => 1,
        'expected'  => true,
    ],
    'integer with string inclusive' => [
        'min'       => 1,
        'max'       => 3,
        'inclusive' => true,
        'input'     => '1',
        'expected'  => true,
    ],
    'float with string inclusive' => [
        'min'       => 1.0,
        'max'       => 3.0,
        'inclusive' => true,
        'input'     => '1.0',
        'expected'  => true,
    ],
]);
