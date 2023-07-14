<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\String;

use ExeQue\Remix\Exceptions\InvalidArgumentException;
use ExeQue\Remix\Mutate\String\Substring;

it('extracts a substring', function (mixed $start, mixed $length, mixed $input, mixed $expected) {
    $mutator = Substring::make($start, $length);

    expect($mutator->mutate($input))->toBe($expected);
})->with([
    'non-multi-byte' => [
        'start'    => 0,
        'length'   => 3,
        'input'    => 'foobarbaz',
        'expected' => 'foo',
    ],
    'multi-byte' => [
        'start'    => 0,
        'length'   => 2,
        'input'    => 'ægæg',
        'expected' => 'æg',
    ],
    'negative start' => [
        'start'    => -3,
        'length'   => 2,
        'input'    => 'foobarbaz',
        'expected' => 'ba',
    ],
    'negative length' => [
        'start'    => 0,
        'length'   => -2,
        'input'    => 'foobarbaz',
        'expected' => 'foobarb',
    ],
    'negative start and length' => [
        'start'    => -3,
        'length'   => -2,
        'input'    => 'foobarbaz',
        'expected' => 'b',
    ],
    'start out of bounds' => [
        'start'    => 100,
        'length'   => 2,
        'input'    => 'foobarbaz',
        'expected' => '',
    ],
    'length out of bounds' => [
        'start'    => 0,
        'length'   => 100,
        'input'    => 'foobarbaz',
        'expected' => 'foobarbaz',
    ],
    'start and length out of bounds' => [
        'start'    => 100,
        'length'   => 100,
        'input'    => 'foobarbaz',
        'expected' => '',
    ],
    'start and length out of bounds with negative length' => [
        'start'    => 100,
        'length'   => -100,
        'input'    => 'foobarbaz',
        'expected' => '',
    ],
    'start and length out of bounds with negative start' => [
        'start'    => -100,
        'length'   => 100,
        'input'    => 'foobarbaz',
        'expected' => 'foobarbaz',
    ],
    'start and length out of bounds with negative start and length' => [
        'start'    => -100,
        'length'   => -100,
        'input'    => 'foobarbaz',
        'expected' => '',
    ],
    'using stringable input' => [
        'start'  => 0,
        'length' => 3,
        'input'  => new class () {
            public function __toString(): string
            {
                return 'foobarbaz';
            }
        },
        'expected' => 'foo',
    ],
]);

it('throws an exception when given a non-stringable input', function () {
    $mutator = Substring::make(0, 1);

    $mutator->mutate([]);
})->throws(InvalidArgumentException::class);

it('throws an exception when given an invalid encoding', function () {
    Substring::make(0, 1, 'invalid');
})->throws(InvalidArgumentException::class);
