<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\Array;

use ArrayIterator;
use ExeQue\Remix\Exceptions\InvalidArgumentException;
use ExeQue\Remix\Mutate\Array\First;

it('gets the first element of an array', function (mixed $callback, mixed $input, mixed $expected) {
    $mutator = First::make($callback);

    expect($mutator->mutate($input))->toBe($expected);
})->with([
    'no callback' => [
        'callback' => null,
        'input'    => ['foo', 'bar'],
        'expected' => 'foo',
    ],
    'callback' => [
        'callback' => static fn ($value) => $value === 'bar',
        'input'    => ['foo', 'bar'],
        'expected' => 'bar',
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
        'expected' => 'foo',
    ],
]);

it('callback is provided with value and key', function () {
    $mutator = First::make(static function ($value, $key) {
        expect($value)->toBe('bar')
            ->and($key)->toBe('foo');

        return true;
    });

    $mutator->mutate(['foo' => 'bar']);
});

it('throws an exception if given a non-iterable input', function () {
    $mutator = First::make(static fn () => true);

    $mutator->mutate('foo');
})->throws(InvalidArgumentException::class);
