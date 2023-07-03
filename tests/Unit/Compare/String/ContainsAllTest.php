<?php

declare(strict_types=1);

namespace Tests\Unit\Compare\String;

use ExeQue\Remix\Compare\String\ContainsAll;
use ExeQue\Remix\Exceptions\InvalidArgumentException;
use Stringable;

test('string contains all of the given strings', function (string $input, array $needles, bool $expected) {
    $mutator = ContainsAll::make($needles);

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
    'contains all' => [
        'input'    => 'foo',
        'needles'  => ['f', 'o'],
        'expected' => true,
    ],
    'does not contain all' => [
        'input'    => 'foo',
        'needles'  => ['f', 'o', 'b'],
        'expected' => false,
    ],
]);

test('string contains all of the given strings regardless of casing', function () {
    $mutator = ContainsAll::make(['O', 'F'], false);

    expect($mutator->check('foo'))->toBeTrue();
});

test('string does not contain all of the given strings regardless of casing', function () {
    $mutator = ContainsAll::make(['B', 'Q'], false);

    expect($mutator->check('foo'))->toBeFalse();
});

test('fail if given any non-stringable search value', function (array $search) {
    ContainsAll::make($search);
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
    ContainsAll::make($search);
})->with(function () {
    $stringable = new class implements Stringable
    {
        public function __toString(): string
        {
            return 'foo';
        }
    };

    return [
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
            'search' => [$stringable],
        ],
    ];
})->throwsNoExceptions();
