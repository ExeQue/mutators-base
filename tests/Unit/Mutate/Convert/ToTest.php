<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\Convert;

use ArrayIterator;
use ExeQue\Remix\Exceptions\InvalidArgumentException;
use ExeQue\Remix\Mutate\Convert\To;

it('converts to type', function (string $type, mixed $input, mixed $expected) {
    $mutator = To::make($type);

    expect($mutator->mutate($input))->toEqual($expected);
})->with([
    'string to string' => [
        'type'     => 'string',
        'input'    => 'foo',
        'expected' => 'foo',
    ],
    'string to int' => [
        'type'     => 'int',
        'input'    => '1',
        'expected' => 1,
    ],
    'string to float' => [
        'type'     => 'float',
        'input'    => '1.1',
        'expected' => 1.1,
    ],
    'string to bool' => [
        'type'     => 'bool',
        'input'    => 'true',
        'expected' => true,
    ],
    'string to array' => [
        'type'     => 'array',
        'input'    => 'foo',
        'expected' => ['foo'],
    ],
    'int to string' => [
        'type'     => 'string',
        'input'    => 1,
        'expected' => '1',
    ],
    'int to int' => [
        'type'     => 'int',
        'input'    => 1,
        'expected' => 1,
    ],
    'int to float' => [
        'type'     => 'float',
        'input'    => 1,
        'expected' => 1.0,
    ],
    'int to bool' => [
        'type'     => 'bool',
        'input'    => 1,
        'expected' => true,
    ],
    'int to array' => [
        'type'     => 'array',
        'input'    => 1,
        'expected' => [1],
    ],
    'float to string' => [
        'type'     => 'string',
        'input'    => 1.1,
        'expected' => '1.1',
    ],
    'float to int' => [
        'type'     => 'int',
        'input'    => 1.1,
        'expected' => 1,
    ],
    'float to float' => [
        'type'     => 'float',
        'input'    => 1.1,
        'expected' => 1.1,
    ],
    'float to bool' => [
        'type'     => 'bool',
        'input'    => 1.1,
        'expected' => true,
    ],
    'float to array' => [
        'type'     => 'array',
        'input'    => 1.1,
        'expected' => [1.1],
    ],
    'bool to string' => [
        'type'     => 'string',
        'input'    => true,
        'expected' => '1',
    ],
    'bool to int' => [
        'type'     => 'int',
        'input'    => true,
        'expected' => 1,
    ],
    'bool to float' => [
        'type'     => 'float',
        'input'    => true,
        'expected' => 1.0,
    ],
    'bool to bool' => [
        'type'     => 'bool',
        'input'    => true,
        'expected' => true,
    ],
    'bool to array' => [
        'type'     => 'array',
        'input'    => true,
        'expected' => [true],
    ],
    'array to int' => [
        'type'     => 'int',
        'input'    => ['foo'],
        'expected' => 1,
    ],
    'array to float' => [
        'type'     => 'float',
        'input'    => ['foo'],
        'expected' => 1.0,
    ],
    'array to bool' => [
        'type'     => 'bool',
        'input'    => ['foo'],
        'expected' => true,
    ],
    'array to array' => [
        'type'     => 'array',
        'input'    => ['foo'],
        'expected' => ['foo'],
    ],
    'array to object' => [
        'type'     => 'object',
        'input'    => ['foo'],
        'expected' => (object)['foo'],
    ],
    'object to bool' => [
        'type'     => 'bool',
        'input'    => (object)['foo'],
        'expected' => true,
    ],
    'object to array' => [
        'type'     => 'array',
        'input'    => (object)['foo'],
        'expected' => [(object)['foo']],
    ],
    'object to object' => [
        'type'     => 'object',
        'input'    => (object)['foo'],
        'expected' => (object)['foo'],
    ],
    'stringable object to string' => [
        'type'  => 'string',
        'input' => new class () {
            public function __toString(): string
            {
                return 'foo';
            }
        },
        'expected' => 'foo',
    ],
    'iterable to array' => [
        'type'     => 'array',
        'input'    => new ArrayIterator(['foo']),
        'expected' => ['foo'],
    ],
]);

it('throws exception when given invalid input', function (string $type, mixed $input, mixed $expected) {
    $mutator = To::make($type);

    $mutator->mutate($input);
})->throws(InvalidArgumentException::class)->with([
    'string to object' => [
        'type'     => 'object',
        'input'    => 'foo',
        'expected' => (object)['foo'],
    ],
    'int to object' => [
        'type'     => 'object',
        'input'    => 1,
        'expected' => (object)[1],
    ],
    'float to object' => [
        'type'     => 'object',
        'input'    => 1.1,
        'expected' => (object)[1.1],
    ],
    'bool to object' => [
        'type'     => 'object',
        'input'    => true,
        'expected' => (object)[true],
    ],
    'array to string' => [
        'type'     => 'string',
        'input'    => ['foo'],
        'expected' => 'foo',
    ],
    'object to string' => [
        'type'     => 'string',
        'input'    => (object)['foo'],
        'expected' => 'foo',
    ],
    'object to int' => [
        'type'     => 'int',
        'input'    => (object)['foo'],
        'expected' => 1,
    ],
    'object to float' => [
        'type'     => 'float',
        'input'    => (object)['foo'],
        'expected' => 1.0,
    ],
]);

test('aliases are identical to the original', function () {
    expect(To::string())->toEqual(To::make('string'))
        ->and(To::int())->toEqual(To::make('int'))
        ->and(To::int())->toEqual(To::make('integer'))
        ->and(To::float())->toEqual(To::make('float'))
        ->and(To::float())->toEqual(To::make('double'))
        ->and(To::bool())->toEqual(To::make('bool'))
        ->and(To::bool())->toEqual(To::make('boolean'))
        ->and(To::array())->toEqual(To::make('array'))
        ->and(To::object())->toEqual(To::make('object'));
});

it('throws exception when given invalid type', function () {
    To::make('foo');
})->throws(InvalidArgumentException::class);
