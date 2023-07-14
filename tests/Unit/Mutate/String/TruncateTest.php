<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\String;

use ExeQue\Remix\Exceptions\InvalidArgumentException;
use ExeQue\Remix\Mutate\String\Truncate;

it('truncates a string', function (mixed $length, mixed $ellipsis, mixed $input, mixed $expected) {
    $mutator = Truncate::make($length, $ellipsis);

    expect($mutator->mutate($input))->toBe($expected);
})->with([
    'length is greater than string length' => [
        'length'   => 10,
        'ellipsis' => '...',
        'input'    => 'foo',
        'expected' => 'foo',
    ],
    'length is less than string length' => [
        'length'   => 2,
        'ellipsis' => '...',
        'input'    => 'foo',
        'expected' => 'fo...',
    ],
    'length is equal to string length' => [
        'length'   => 3,
        'ellipsis' => '...',
        'input'    => 'foo',
        'expected' => 'foo',
    ],
    'ellipsis is custom' => [
        'length'   => 2,
        'ellipsis' => '---',
        'input'    => 'foo',
        'expected' => 'fo---',
    ],
    'using stringable input' => [
        'length'   => 2,
        'ellipsis' => '...',
        'input'    => new class () {
            public function __toString(): string
            {
                return 'foo';
            }
        },
        'expected' => 'fo...',
    ],
]);



it('throws an exception when given a non-stringable input', function () {
    $mutator = Truncate::make(2);

    $mutator->mutate([]);
})->throws(InvalidArgumentException::class);
