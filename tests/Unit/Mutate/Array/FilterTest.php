<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\Array;

use ArrayIterator;
use ExeQue\Remix\Exceptions\InvalidArgumentException;
use ExeQue\Remix\Mutate\Array\Filter;

it('filters an array', function (mixed $callback, mixed $input, mixed $expected) {
    $mutator = Filter::make($callback);

    expect($mutator->mutate($input))->toBe($expected);
})->with([
    'no callback' => [
        'callback' => null,
        'input'    => ['foo', 'bar', 'baz', null, false],
        'expected' => ['foo', 'bar', 'baz'],
    ],
    'callback' => [
        'callback' => function ($value) {
            return ! is_string($value);
        },
        'input'    => ['foo', 'bar', 'baz', null, false],
        'expected' => [3 => null, 4 => false],
    ],
    'iterator' => [
        'callback' => null,
        'input'    => new ArrayIterator(['foo', 'bar', 'baz', null, false]),
        'expected' => ['foo', 'bar', 'baz'],
    ],
]);

it('gives value and key to callback', function () {
    $mutator = Filter::make(function ($value, $key) {
        expect($value)->toBe('foo')
            ->and($key)->toBe(0);
    });

    $mutator->mutate(['foo']);
});

it('throws an exception if given a non-iterable input', function () {
    $mutator = Filter::make(function () {});

    $mutator->mutate('foo');
})->throws(InvalidArgumentException::class);
