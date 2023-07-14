<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\String;

use ExeQue\Remix\Exceptions\InvalidArgumentException;
use ExeQue\Remix\Mutate\String\Mask;

it('masks matches', function () {
    $mutator = Mask::make('/\w+/');

    expect($mutator->mutate('hello there'))->toBe('***** *****');
});

it('masks nothing if nothing matches pattern', function () {
    $mutator = Mask::make('/\d+/');

    expect($mutator->mutate('foobar'))->toBe('foobar');
});

it('masks same length as matched pattern', function (string $pattern, string $input, string $expected) {
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

it('throws an exception if replacement character is not a single character', function () {
    Mask::make('/\w+/', 'foo');
})->throws(InvalidArgumentException::class);

it('throws an exception if replacement character is empty', function () {
    Mask::make('/\w+/', '');
})->throws(InvalidArgumentException::class);
