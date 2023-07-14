<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\Number;

use ExeQue\Remix\Exceptions\InvalidArgumentException;
use ExeQue\Remix\Mutate\Number\Math\Add;
use ExeQue\Remix\Mutate\Number\Math\Divide;
use ExeQue\Remix\Mutate\Number\Math\Modulo;
use ExeQue\Remix\Mutate\Number\Math\Multiply;
use ExeQue\Remix\Mutate\Number\Math\Pow;
use ExeQue\Remix\Mutate\Number\Math\Root;
use ExeQue\Remix\Mutate\Number\Math\Subtract;

it('adds two numbers', function (mixed $addend, mixed $input, mixed $expected) {
    $add = Add::make($addend);

    expect(round($add->mutate($input), 3))->toEqual($expected);
})->with([
    'int' => [
        'one'      => 1,
        'two'      => 2,
        'expected' => 3,
    ],
    'float' => [
        'one'      => 1.1,
        'two'      => 2.2,
        'expected' => 3.3,
    ],
]);

it('subtracts two numbers', function (mixed $subtrahend, mixed $input, mixed $expected) {
    $subtract = Subtract::make($subtrahend);

    expect(round($subtract->mutate($input), 3))->toEqual($expected);
})->with([
    'int' => [
        'subtrahend' => 1,
        'input'      => 2,
        'expected'   => 1,
    ],
    'float' => [
        'subtrahend' => 1.1,
        'input'      => 2.2,
        'expected'   => 1.1,
    ],
]);

it('divides two numbers', function (mixed $divisor, mixed $input, mixed $expected) {
    $divide = Divide::make($divisor);

    expect(round($divide->mutate($input), 3))->toEqual($expected);
})->with([
    'int' => [
        'divisor'  => 2,
        'input'    => 4,
        'expected' => 2,
    ],
    'float' => [
        'divisor'  => 2.2,
        'input'    => 4.4,
        'expected' => 2,
    ],
]);

it('throws an exception if attempting division by zero', function () {
    $divide = Divide::make(0);

    $divide->mutate(4);
})->throws(InvalidArgumentException::class);

it('multiplies two numbers', function (mixed $multiplier, mixed $input, mixed $expected) {
    $multiply = Multiply::make($multiplier);

    expect(round($multiply->mutate($input), 3))->toEqual($expected);
})->with([
    'int' => [
        'multiplier' => 2,
        'input'      => 4,
        'expected'   => 8,
    ],
    'float' => [
        'multiplier' => 2.2,
        'input'      => 4.4,
        'expected'   => 9.68,
    ],
]);

it('gets the modulo of two numbers', function (mixed $divisor, mixed $input, mixed $expected) {
    $modulo = Modulo::make($divisor);

    expect(round($modulo->mutate($input), 3))->toEqual($expected);
})->with([
    'int' => [
        'divisor'  => 2,
        'input'    => 4,
        'expected' => 0,
    ],
    'int with remainder' => [
        'divisor'  => 3,
        'input'    => 4,
        'expected' => 1,
    ],
    'float' => [
        'divisor'  => 2.2,
        'input'    => 4.4,
        'expected' => 0,
    ],
    'float with remainder' => [
        'divisor'  => 3.3,
        'input'    => 4.4,
        'expected' => 1.1,
    ],
]);

it('raises a number to a power', function (mixed $exponent, mixed $input, mixed $expected) {
    $pow = Pow::make($exponent);

    expect(round($pow->mutate($input), 3))->toEqual($expected);
})->with(function () {
    return [
        'int' => [
            'exponent' => 2,
            'input'    => 4,
            'expected' => 16,
        ],
        'float' => [
            'exponent' => 2.2,
            'input'    => 4.4,
            'expected' => 26.037,
        ],
    ];
});

it('uses square alias on pow', function () {
    $pow = Pow::square();

    expect($pow)->toEqual(Pow::make(2))
        ->and($pow->mutate(4))->toEqual(16);
});

it('uses cube alias on pow', function () {
    $pow = Pow::cube();

    expect($pow)->toEqual(Pow::make(3))
        ->and($pow->mutate(4))->toEqual(64);
});

it('gets the root of a number', function (mixed $root, mixed $input, mixed $expected) {
    $root = Root::make($root);

    expect(round($root->mutate($input), 3))->toEqual($expected);
})->with(function () {
    return [
        'int' => [
            'root'     => 2,
            'input'    => 4,
            'expected' => 2,
        ],
        'float' => [
            'root'     => 2.2,
            'input'    => 4.4,
            'expected' => 1.961,
        ],
    ];
});

it('uses square alias on root', function () {
    $root = Root::square();

    expect($root)->toEqual(Root::make(2))
        ->and($root->mutate(4))->toEqual(2);
});

it('uses cube alias on root', function () {
    $root = Root::cube();

    expect($root)->toEqual(Root::make(3))
        ->and($root->mutate(8))->toEqual(2);
});
