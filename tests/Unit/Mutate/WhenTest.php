<?php

declare(strict_types=1);

namespace Tests\Unit;

use ExeQue\Remix\Exceptions\InvalidArgumentException;
use ExeQue\Remix\Mutate\When;

it('executes then or otherwise depending on condition', function (mixed $condition, mixed $then, mixed $otherwise, mixed $input, mixed $expected) {
    $mutator = When::make($condition, $then, $otherwise);

    expect($mutator->mutate($input))->toBe($expected);
})->with([
    'condition is true' => [
        'condition' => true,
        'then'      => static fn ($value) => $value . 'bar',
        'otherwise' => static fn ($value) => $value . 'baz',
        'input'     => 'foo',
        'expected'  => 'foobar',
    ],
    'condition is false' => [
        'condition' => false,
        'then'      => static fn ($value) => $value . 'bar',
        'otherwise' => static fn ($value) => $value . 'baz',
        'input'     => 'foo',
        'expected'  => 'foobaz',
    ],
    'condition is truthy' => [
        'condition' => 'foo',
        'then'      => static fn ($value) => $value . 'bar',
        'otherwise' => static fn ($value) => $value . 'baz',
        'input'     => 'foo',
        'expected'  => 'foobar',
    ],
    'condition is falsy' => [
        'condition' => '',
        'then'      => static fn ($value) => $value . 'bar',
        'otherwise' => static fn ($value) => $value . 'baz',
        'input'     => 'foo',
        'expected'  => 'foobaz',
    ],
    'condition is callable' => [
        'condition' => static fn ($value) => $value === 'foo',
        'then'      => static fn ($value) => $value . 'bar',
        'otherwise' => static fn ($value) => $value . 'baz',
        'input'     => 'foo',
        'expected'  => 'foobar',
    ],
    'using sequence for then' => [
        'condition' => true,
        'then'      => [
            static fn ($value) => $value . 'bar',
            static fn ($value) => $value . 'baz',
        ],
        'otherwise' => static fn ($value) => $value . 'qux',
        'input'     => 'foo',
        'expected'  => 'foobarbaz',
    ],
    'using sequence for otherwise' => [
        'condition' => false,
        'then'      => static fn ($value) => $value . 'bar',
        'otherwise' => [
            static fn ($value) => $value . 'baz',
            static fn ($value) => $value . 'qux',
        ],
        'input'    => 'foo',
        'expected' => 'foobazqux',
    ],
    'does not mutate when condition is not met' => [
        'condition' => false,
        'then'      => static fn ($value) => $value . 'bar',
        'otherwise' => null,
        'input'     => 'foo',
        'expected'  => 'foo',
    ],
]);

it('throws an exception when given an invalid input', function (mixed $condition, mixed $then, mixed $otherwise) {
    When::make($condition, $then, $otherwise);
})->throws(InvalidArgumentException::class)->with([
    'then' => [
        'condition' => true,
        'then'      => 'foo',
        'otherwise' => static fn ($value) => $value . 'baz',
    ],
    'otherwise' => [
        'condition' => true,
        'then'      => static fn ($value) => $value . 'bar',
        'otherwise' => 'foo',
    ],
]);
