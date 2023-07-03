<?php

declare(strict_types=1);

namespace Tests\Unit\String;

use ExeQue\Mutators\Exceptions\InvalidArgumentException;
use ExeQue\Mutators\String\Mask;

test('masks matches', function () {
    $mutator = Mask::make('/\w+/');

    expect($mutator->mutate('hello there'))->toBe('***** *****');
});

test('masks nothing if nothing matches pattern', function () {
    $mutator = Mask::make('/\d+/');

    expect($mutator->mutate('foobar'))->toBe('foobar');
});

test('masks same length as matched pattern', function (string $pattern, string $input, string $expected) {
    $mutator = new Mask($pattern);

    expect($mutator->mutate($input))->toBe($expected);
})->with([
    'non-multibyte string' => [
        'pattern'  => '/\S+/',
        'input'    => 'hello there',
        'expected' => '***** *****',
    ],
    'multibyte string' => [
        'pattern'  => '/\S+/',
        'input'    => 'æøå ûîê',
        'expected' => '*** ***',
    ],
]);

test('fails if replacement character is not a single character', function () {
    Mask::make('/\w+/', 'foo');
})->throws(InvalidArgumentException::class);

test('fails if replacement character is empty', function () {
    Mask::make('/\w+/', '');
})->throws(InvalidArgumentException::class);
