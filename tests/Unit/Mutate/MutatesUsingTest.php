<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate;

use ExeQue\Remix\Exceptions\InvalidArgumentException;
use ExeQue\Remix\Mutate\MutatesUsing;

it('accepts any callable', function (mixed $callback, mixed $input, mixed $expected) {
    $mutator = MutatesUsing::make($callback);

    expect($mutator->mutate($input))->toBe($expected);
})->with([
    'function' => [
        'callback' => static fn ($value) => $value . 'bar',
        'input'    => 'foo',
        'expected' => 'foobar',
    ],
    'first-class callable' => [
        'callback' => strrev(...),
        'input'    => 'foo',
        'expected' => 'oof',
    ],
    'invokable class' => [
        'callback' => new class () {
            public function __invoke($value)
            {
                return $value . 'bar';
            }
        },
        'input'    => 'foo',
        'expected' => 'foobar',
    ],
]);

it('throws an exception when given a non-callable', function (mixed $callback) {
    MutatesUsing::make($callback);
})->throws(InvalidArgumentException::class)->with([
    'string' => [
        'callback' => 'foo',
    ],
    'string function' => [
        'callback' => 'strlen',
    ],
    'object' => [
        'callback' => new class () {
            public function foo()
            {
                return 'bar';
            }
        },
    ],
    'array' => [
        'callback' => ['foo', 'bar'],
    ],
]);
