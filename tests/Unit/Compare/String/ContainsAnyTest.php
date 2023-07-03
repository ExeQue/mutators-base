<?php

declare(strict_types=1);

namespace Tests\Unit\Compare\String;

use ExeQue\Remix\Compare\String\ContainsAny;
use ExeQue\Remix\Exceptions\InvalidArgumentException;
use Stringable;

test('string contains any of the given strings', function (string $input, array $needles, bool $expected) {
    $mutator = ContainsAny::make($needles);

    expect($mutator->check($input))->toBe($expected);
})->with([
    'contains' => [
        'input'    => 'foo',
        'needles'  => ['o'],
        'expected' => true,
    ],
    'does not contain' => [
        'input'    => 'foo',
        'needles'  => ['bar'],
        'expected' => false,
    ],
    'contains any' => [
        'input'    => 'foo',
        'needles'  => ['bar', 'o'],
        'expected' => true,
    ],
    'does not contain any' => [
        'input'    => 'foo',
        'needles'  => ['bar', 'baz'],
        'expected' => false,
    ],
]);

test('string contains any of the given strings regardless of casing', function () {
    $mutator = ContainsAny::make(['O'], false);

    expect($mutator->check('foo'))->toBeTrue();
});

test('fail if given any non-stringable search value', function (array $search) {
    ContainsAny::make($search);
})->with([
    'array' => [
        'search' => [[]],
    ],
    'object' => [
        'search' => [new class
        {
        }],
    ],
    'callable' => [
        'search' => [static fn () => 'foo'],
    ],
    'resource' => [
        'search' => [fopen('php://memory', 'rb')],
    ],
    'bool' => [
        'search' => [true],
    ],
])->throws(InvalidArgumentException::class);

test('makes if given any any stringable search value', function (array $search) {
    ContainsAny::make($search);
})->with([
    'string' => [
        'search' => ['foo'],
    ],
    'int' => [
        'search' => [1],
    ],
    'float' => [
        'search' => [1.1],
    ],
    'null' => [
        'search' => [null],
    ],
    'stringable' => [
        'search' => [new class implements Stringable
        {
            public function __toString(): string
            {
                return 'foo';
            }
        }],
    ],
])->throwsNoExceptions();
