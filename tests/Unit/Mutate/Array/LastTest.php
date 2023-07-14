<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\Array;

use ArrayIterator;
use ExeQue\Remix\Exceptions\InvalidArgumentException;
use ExeQue\Remix\Mutate\Array\Last;

it('gets the last element of an array', function (mixed $callback, mixed $input, mixed $expected) {
    $mutator = Last::make($callback);

    expect($mutator->mutate($input))->toBe($expected);
})->with([
    'no callback' => [
        'callback' => null,
        'input'    => ['foo', 'bar'],
        'expected' => 'bar',
    ],
    'callback' => [
        'callback' => static fn ($value) => $value === 'foo',
        'input'    => ['foo', 'bar'],
        'expected' => 'foo',
    ],
    'callback not found' => [
        'callback' => static fn ($value) => $value === 'baz',
        'input'    => ['foo', 'bar'],
        'expected' => null,
    ],
    'empty array' => [
        'callback' => null,
        'input'    => [],
        'expected' => null,
    ],
    'iterator' => [
        'callback' => null,
        'input'    => new ArrayIterator(['foo', 'bar']),
        'expected' => 'bar',
    ],
]);

it('callback is provided with value and key', function () {
    $mutator = Last::make(static function ($value, $key) {
        expect($value)->toBe('bar')
            ->and($key)->toBe('foo');

        return true;
    });

    $mutator->mutate(['foo' => 'bar']);
});

it('throws an exception if given a non-iterable input', function () {
    $mutator = Last::make(static fn () => true);

    $mutator->mutate('foo');
})->throws(InvalidArgumentException::class);
