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

it('checks type of input', function(string $type, mixed $input, bool $expected) {
    $comparator = IsType::make($type);

    expect($comparator->check($input))->toBe($expected);
})->with([
    'string' => [
        'type' => 'string',
        'input' => 'foo',
        'expected' => true,
    ],
    'int' => [
        'type' => 'int',
        'input' => 1,
        'expected' => true,
    ],
    'float' => [
        'type' => 'float',
        'input' => 1.1,
        'expected' => true,
    ],
    'bool' => [
        'type' => 'bool',
        'input' => true,
        'expected' => true,
    ],
    'scalar' => [
        'type' => 'scalar',
        'input' => 'foo',
        'expected' => true,
    ],
    'numeric' => [
        'type' => 'numeric',
        'input' => '1.3',
        'expected' => true,
    ],
    'array' => [
        'type' => 'array',
        'input' => [],
        'expected' => true,
    ],
    'object' => [
        'type' => 'object',
        'input' => new stdClass(),
        'expected' => true,
    ],
    'null' => [
        'type' => 'null',
        'input' => null,
        'expected' => true,
    ],
    'callable' => [
        'type' => 'callable',
        'input' => function() {},
        'expected' => true,
    ],
    'iterable' => [
        'type' => 'iterable',
        'input' => new ArrayIterator(),
        'expected' => true,
    ],
    'resource' => [
        'type' => 'resource',
        'input' => fopen('php://memory', 'rb'),
        'expected' => true,
    ],
    'class' => [
        'type' => stdClass::class,
        'input' => new stdClass(),
        'expected' => true,
    ],
    'interface' => [
        'type' => Iterator::class,
        'input' => new ArrayIterator(),
        'expected' => true,
    ],
    'trait' => [
        'type' => Makes::class,
        'input' => Reverse::make(),
        'expected' => true,
    ],
    'not string' => [
        'type' => 'string',
        'input' => 1,
        'expected' => false,
    ],
    'not int' => [
        'type' => 'int',
        'input' => 'foo',
        'expected' => false,
    ],
    'not float' => [
        'type' => 'float',
        'input' => 'foo',
        'expected' => false,
    ],
    'not bool' => [
        'type' => 'bool',
        'input' => 'foo',
        'expected' => false,
    ],
    'not scalar' => [
        'type' => 'scalar',
        'input' => [],
        'expected' => false,
    ],
    'not numeric' => [
        'type' => 'numeric',
        'input' => 'foo',
        'expected' => false,
    ],
    'not array' => [
        'type' => 'array',
        'input' => 'foo',
        'expected' => false,
    ],
    'not object' => [
        'type' => 'object',
        'input' => 'foo',
        'expected' => false,
    ],
    'not null' => [
        'type' => 'null',
        'input' => 'foo',
        'expected' => false,
    ],
    'not callable' => [
        'type' => 'callable',
        'input' => 'foo',
        'expected' => false,
    ],
    'not iterable' => [
        'type' => 'iterable',
        'input' => 'foo',
        'expected' => false,
    ],
    'not resource' => [
        'type' => 'resource',
        'input' => 'foo',
        'expected' => false,
    ],
    'not class' => [
        'type' => stdClass::class,
        'input' => 'foo',
        'expected' => false,
    ],
    'not interface' => [
        'type' => Iterator::class,
        'input' => 'foo',
        'expected' => false,
    ],
    'not trait' => [
        'type' => Makes::class,
        'input' => 'foo',
        'expected' => false,
    ],
]);

it('throws an exception if given an invalid type', function () {
    IsType::make('foobar');
})->throws(InvalidArgumentException::class);

it('has aliases for all types', function (string $type, $comparatorArgs, array $aliasArgs) {
    $aliasedComparator = call_user_func([IsType::class, $type], ...$aliasArgs);
    $comparator = IsType::make(...$comparatorArgs);

    expect($aliasedComparator)->toEqual($comparator);
})->with([
    'string' => [
        'type' => 'string',
        'comparatorArgs' => ['string'],
        'aliasArgs' => [],
    ],
    'int' => [
        'type' => 'int',
        'compareArgs' => ['int'],
        'aliasArgs' => [],
    ],
    'float' => [
        'type' => 'float',
        'compareArgs' => ['float'],
        'aliasArgs' => [],
    ],
    'bool' => [
        'type' => 'bool',
        'compareArgs' => ['bool'],
        'aliasArgs' => [],
    ],
    'scalar' => [
        'type' => 'scalar',
        'compareArgs' => ['scalar'],
        'aliasArgs' => [],
    ],
    'numeric' => [
        'type' => 'numeric',
        'compareArgs' => ['numeric'],
        'aliasArgs' => [],
    ],
    'array' => [
        'type' => 'array',
        'compareArgs' => ['array'],
        'aliasArgs' => [],
    ],
    'object' => [
        'type' => 'object',
        'compareArgs' => ['object'],
        'aliasArgs' => [],
    ],
    'null' => [
        'type' => 'null',
        'compareArgs' => ['null'],
        'aliasArgs' => [],
    ],
    'callable' => [
        'type' => 'callable',
        'compareArgs' => ['callable'],
        'aliasArgs' => [],
    ],
    'iterable' => [
        'type' => 'iterable',
        'compareArgs' => ['iterable'],
        'aliasArgs' => [],
    ],
    'resource' => [
        'type' => 'resource',
        'compareArgs' => ['resource'],
        'aliasArgs' => [],
    ],
    'class' => [
        'type' => 'class',
        'compareArgs' => [stdClass::class],
        'aliasArgs' => [stdClass::class],
    ],
    'interface' => [
        'type' => 'interface',
        'compareArgs' => [Iterator::class],
        'aliasArgs' => [Iterator::class],
    ],
    'trait' => [
        'type' => 'trait',
        'compareArgs' => [Makes::class],
        'aliasArgs' => [Makes::class],
    ],
]);
