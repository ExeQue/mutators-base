<?php

declare(strict_types=1);

namespace Tests\Unit;

use ExeQue\Remix\Assert;

test('passes stringable', function (mixed $input) {
    Assert::stringable($input);
})->throwsNoExceptions()->with([
    'string'     => 'foo',
    'int'        => 1,
    'float'      => 1.1,
    'null'       => null,
    'stringable' => new class implements \Stringable
    {
        public function __toString(): string
        {
            return 'foo';
        }
    },
]);

test('fails stringable', function (mixed $input) {
    Assert::stringable($input);
})->throws(\InvalidArgumentException::class)->with([
    'bool'     => true,
    'array'    => fn () => [],
    'object'   => new \stdClass(),
    'callable' => fn () => function () {
    },
    'iterable' => new \ArrayIterator(),
    'resource' => fopen('php://memory', 'rb'),
]);

test('passes allStringable', function () {
    Assert::allStringable([
        'string'     => 'foo',
        'int'        => 1,
        'float'      => 1.1,
        'null'       => null,
        'stringable' => new class implements \Stringable
        {
            public function __toString(): string
            {
                return 'foo';
            }
        },
    ]);
})->throwsNoExceptions();

test('fails allStringable', function () {
    Assert::allStringable([
        'bool'     => true,
        'array'    => [],
        'object'   => new \stdClass(),
        'callable' => function () {
        },
        'iterable' => new \ArrayIterator(),
        'resource' => fopen('php://memory', 'rb'),
    ]);
})->throws(\InvalidArgumentException::class);

test('passes intOrFloat', function (mixed $input) {
    Assert::intOrFloat($input);
})->throwsNoExceptions()->with([
    'int'   => 1,
    'float' => 1.1,
]);

test('fails intOrFloat', function (mixed $input) {
    Assert::intOrFloat($input);
})->throws(\InvalidArgumentException::class)->with([
    'string'   => 'foo',
    'bool'     => true,
    'null'     => null,
    'array'    => fn () => [],
    'object'   => new \stdClass(),
    'callable' => fn () => function () {
    },
    'iterable' => new \ArrayIterator(),
    'resource' => fopen('php://memory', 'rb'),
]);

test('passes allIntOrFloat', function () {
    Assert::allIntOrFloat([
        'int'   => 1,
        'float' => 1.1,
    ]);
})->throwsNoExceptions();
