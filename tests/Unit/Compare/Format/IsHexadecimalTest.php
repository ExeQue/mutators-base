<?php

declare(strict_types=1);

namespace Tests\Unit\Compare\Format;

use ExeQue\Remix\Compare\Format\IsHexadecimal;
use ExeQue\Remix\Exceptions\InvalidArgumentException;
use stdClass;

it('checks if string is hexadecimal', function (bool $bytes, string $input, mixed $expected) {
    $comparator = IsHexadecimal::make($bytes);

    expect($comparator->check($input))->toBe($expected);
})->with([
    'checks if string is hexadecimal' => [
        'bytes'    => false,
        'input'    => 'ff',
        'expected' => true,
    ],
    'checks if string is not hexadecimal' => [
        'bytes'    => false,
        'input'    => 'Hello World',
        'expected' => false,
    ],
    'checks if string is not hexadecimal with a prefix' => [
        'bytes'    => false,
        'input'    => '0xff',
        'expected' => true,
    ],
    'checks if string is hexadecimal bytes with spaces' => [
        'bytes'    => true,
        'input'    => 'ff ff',
        'expected' => true,
    ],
]);

it('throws an exception if input is not a string', function (mixed $input) {
    IsHexadecimal::make()->check($input);
})->throws(InvalidArgumentException::class)->with([
    'array' => [
        'input' => [],
    ],
    'object' => [
        'input' => new stdClass(),
    ],
    'boolean' => [
        'input' => true,
    ],
]);
