<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\Convert;

use ArrayIterator;
use ExeQue\Remix\Exceptions\InvalidArgumentException;
use ExeQue\Remix\Mutate\Convert\ToArray;
use ExeQue\Remix\Mutate\Convert\ToBool;
use ExeQue\Remix\Mutate\Convert\ToFloat;
use ExeQue\Remix\Mutate\Convert\ToInt;
use ExeQue\Remix\Mutate\Convert\ToObject;
use ExeQue\Remix\Mutate\Convert\ToString;
use stdClass;
use Tests\Fixtures\DataFixture;

it('converts to bool', function (mixed $input, bool $expected) {
    $mutator = ToBool::make();

    expect($mutator->mutate($input))->toBe($expected);
})->with([
    'true string' => [
        'input'    => 'true',
        'expected' => true,
    ],
    'false string' => [
        'input'    => 'false',
        'expected' => true,
    ],
    '1' => [
        'input'    => '1',
        'expected' => true,
    ],
    '0' => [
        'input'    => '0',
        'expected' => false,
    ],
    'null' => [
        'input'    => null,
        'expected' => false,
    ],
    'int zero' => [
        'input'    => 0,
        'expected' => false,
    ],
    'int one' => [
        'input'    => 1,
        'expected' => true,
    ],
    'int nex one' => [
        'input'    => -1,
        'expected' => true,
    ],
    'float' => [
        'input'    => 1.0,
        'expected' => true,
    ],
    'string' => [
        'input'    => 'foo',
        'expected' => true,
    ],
    'empty string' => [
        'input'    => '',
        'expected' => false,
    ],
    'array' => [
        'input'    => ['foo'],
        'expected' => true,
    ],
    'empty array' => [
        'input'    => [],
        'expected' => false,
    ],
    'object' => [
        'input'    => new stdClass(),
        'expected' => true,
    ],
    'resource' => [
        'input'    => fopen('php://memory', 'rb'),
        'expected' => true,
    ],
]);

it('converts to string', function (mixed $input, string $expected) {
    $mutator = ToString::make();

    expect($mutator->mutate($input))->toBe($expected);
})->with([
    'string' => [
        'input'    => 'foo',
        'expected' => 'foo',
    ],
    'int' => [
        'input'    => 1,
        'expected' => '1',
    ],
    'float' => [
        'input'    => 1.1,
        'expected' => '1.1',
    ],
    'bool true' => [
        'input'    => true,
        'expected' => '1',
    ],
    'bool false' => [
        'input'    => false,
        'expected' => '',
    ],
    'null' => [
        'input'    => null,
        'expected' => '',
    ],
]);

it('fails to convert to string', function (mixed $input) {
    ToString::make()->mutate($input);
})->throws(InvalidArgumentException::class)->with([
    'array' => [
        'input' => ['foo'],
    ],
    'object' => [
        'input' => new stdClass(),
    ],
    'resource' => [
        'input' => fopen('php://memory', 'rb'),
    ],
]);

it('converts to float', function (mixed $input, float $expected) {
    $mutator = ToFloat::make();

    expect($mutator->mutate($input))->toBe($expected);
})->with([
    'string' => [
        'input'    => '1.1',
        'expected' => 1.1,
    ],
    'int' => [
        'input'    => 1,
        'expected' => 1.0,
    ],
    'float' => [
        'input'    => 1.1,
        'expected' => 1.1,
    ],
    'bool true' => [
        'input'    => true,
        'expected' => 1.0,
    ],
    'bool false' => [
        'input'    => false,
        'expected' => 0.0,
    ],
    'null' => [
        'input'    => null,
        'expected' => 0.0,
    ],
]);

it('fails to convert to float', function (mixed $input) {
    dd(ToFloat::make()->mutate($input));
})->throws(InvalidArgumentException::class)->with([
    'array' => [
        'input' => ['foo'],
    ],
    'object' => [
        'input' => new stdClass(),
    ],
    'resource' => [
        'input' => fopen('php://memory', 'rb'),
    ],
]);

it('converts to int', function (mixed $input, int $expected) {
    $mutator = ToInt::make();

    expect($mutator->mutate($input))->toBe($expected);
})->with([
    'string' => [
        'input'    => '1',
        'expected' => 1,
    ],
    'int' => [
        'input'    => 1,
        'expected' => 1,
    ],
    'float' => [
        'input'    => 1.1,
        'expected' => 1,
    ],
    'bool true' => [
        'input'    => true,
        'expected' => 1,
    ],
    'bool false' => [
        'input'    => false,
        'expected' => 0,
    ],
    'null' => [
        'input'    => null,
        'expected' => 0,
    ],
]);

it('fails to convert to int', function (mixed $input) {
    ToInt::make()->mutate($input);
})->throws(InvalidArgumentException::class)->with([
    'array' => [
        'input' => ['foo'],
    ],
    'object' => [
        'input' => new stdClass(),
    ],
    'resource' => [
        'input' => fopen('php://memory', 'rb'),
    ],
]);

it('converts to array', function (mixed $input, array $expected) {
    $mutator = ToArray::make();

    expect($mutator->mutate($input))->toBe($expected);
})->with(function () {
    $resource = fopen('php://memory', 'rb');

    $data = new DataFixture([
        'foo' => 'bar',
    ]);

    return [
        'string' => [
            'input'    => 'foo',
            'expected' => ['foo'],
        ],
        'int' => [
            'input'    => 1,
            'expected' => [1],
        ],
        'float' => [
            'input'    => 1.1,
            'expected' => [1.1],
        ],
        'bool true' => [
            'input'    => true,
            'expected' => [true],
        ],
        'bool false' => [
            'input'    => false,
            'expected' => [false],
        ],
        'null' => [
            'input'    => null,
            'expected' => [],
        ],
        'array' => [
            'input'    => ['foo'],
            'expected' => ['foo'],
        ],
        'iterator' => [
            'input'    => new ArrayIterator(['foo']),
            'expected' => ['foo'],
        ],
        'object' => [
            'input'    => $data,
            'expected' => [$data],
        ],
        'resource' => [
            'input'    => $resource,
            'expected' => [$resource],
        ],
    ];
});

it('converts to object', function (mixed $input, mixed $expected) {
    $mutator = ToObject::make();

    expect($mutator->mutate($input))->toEqual($expected);
})->with(function () {
    $resource = fopen('php://memory', 'rb');

    $data = new DataFixture([
        'foo' => 'bar',
    ]);

    return [
        'string' => [
            'input'    => 'foo',
            'expected' => (object)['scalar' => 'foo'],
        ],
        'int' => [
            'input'    => 1,
            'expected' => (object)['scalar' => 1],
        ],
        'float' => [
            'input'    => 1.1,
            'expected' => (object)['scalar' => 1.1],
        ],
        'bool true' => [
            'input'    => true,
            'expected' => (object)['scalar' => true],
        ],
        'bool false' => [
            'input'    => false,
            'expected' => (object)['scalar' => false],
        ],
        'null' => [
            'input'    => null,
            'expected' => (object)[],
        ],
        'array' => [
            'input'    => ['foo'],
            'expected' => (object)['foo'],
        ],
        'object' => [
            'input'    => $data,
            'expected' => $data,
        ],
        'resource' => [
            'input'    => $resource,
            'expected' => (object)['scalar' => $resource],
        ],
    ];
});
