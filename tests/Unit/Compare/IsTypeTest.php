<?php

declare(strict_types=1);

namespace Tests\Unit\Compare;

use ArrayIterator;
use ExeQue\Remix\Compare\IsType;
use ExeQue\Remix\Concerns\Makes;
use ExeQue\Remix\Exceptions\InvalidArgumentException;
use ExeQue\Remix\Mutate\Array\Reverse;
use Iterator;
use stdClass;

test('supports all types', function (string $type, mixed $value) {
    expect(IsType::make($type)->check($value))->toBeTrue();
})->with([
    'string'   => ['string', 'foo'],
    'int'      => ['int', 1],
    'float'    => ['float', 1.1],
    'bool'     => ['bool', true],
    'scalar'   => ['scalar', 'foo'],
    'array'    => ['array', []],
    'object'   => ['object', new stdClass()],
    'null'     => ['null', null],
    'callable' => ['callable', function () {
    }],
    'iterable'  => ['iterable', new ArrayIterator()],
    'resource'  => ['resource', fopen('php://memory', 'rb')],
    'class'     => [stdClass::class, new stdClass()],
    'interface' => [Iterator::class, new ArrayIterator()],
    'trait'     => [Makes::class, Reverse::make()],
]);

test('fails if given unsupported type', function () {
    IsType::make('foobar');
})->throws(InvalidArgumentException::class);
