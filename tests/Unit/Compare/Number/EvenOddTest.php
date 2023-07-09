<?php

declare(strict_types=1);

namespace Tests\Unit\Compare\Number;

use ExeQue\Remix\Compare\Number\IsEven;
use ExeQue\Remix\Compare\Number\IsOdd;
use ExeQue\Remix\Exceptions\InvalidArgumentException;
use stdClass;

it('checks if number is even', function (mixed $input, bool $expected) {
    $comparator = IsEven::make();

    expect($comparator->check($input))->toBe($expected);
})->with([
    'even value' => [
        'input'    => 2,
        'expected' => true,
    ],
    'odd value' => [
        'input'    => 3,
        'expected' => false,
    ],
    'float value under .5' => [
        'input'    => 3.2,
        'expected' => false,
    ],
    'float value over .5' => [
        'input'    => 3.6,
        'expected' => false,
    ],
    'numeric string' => [
        'input'    => '2',
        'expected' => true,
    ],
]);

it('checks if number is odd', function (mixed $input, bool $expected) {
    $comparator = IsOdd::make();

    expect($comparator->check($input))->toBe($expected);
})->with([
    'even value' => [
        'input'    => 2,
        'expected' => false,
    ],
    'odd value' => [
        'input'    => 3,
        'expected' => true,
    ],
    'float value under .5' => [
        'input'    => 3.2,
        'expected' => true,
    ],
    'float value over .5' => [
        'input'    => 3.6,
        'expected' => true,
    ],
    'numeric string' => [
        'input'    => '3',
        'expected' => true,
    ],
]);

it('throws an exception if input is not a number (even)', function (mixed $input) {
    IsEven::make()->check($input);
})->throws(InvalidArgumentException::class)->with('invalid input');

it('throws an exception if input is not a number (odd)', function (mixed $input) {
    IsOdd::make()->check($input);
})->throws(InvalidArgumentException::class)->with('invalid input');

dataset('invalid input', [
    'non-numeric string' => [
        'input' => 'foo',
    ],
    'object' => [
        'input' => new stdClass(),
    ],
]);
