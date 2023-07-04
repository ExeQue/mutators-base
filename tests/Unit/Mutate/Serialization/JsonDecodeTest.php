<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\Serialization;

use ExeQue\Remix\Exceptions\JsonException;
use ExeQue\Remix\Mutate\Serialization\JsonDecode;

test('decodes the json to a value', function (string $input, mixed $expected) {
    $mutator = JsonDecode::make();

    expect($mutator->mutate($input))->toBe($expected);
})->with([
    'simple' => [
        'input'    => '{"foo":"bar"}',
        'expected' => ['foo' => 'bar'],
    ],
    'complex' => [
        'input'    => '{"foo":{"bar":"baz"}}',
        'expected' => ['foo' => ['bar' => 'baz']],
    ],
    'string' => [
        'input'    => '"foo"',
        'expected' => 'foo',
    ],
    'int' => [
        'input'    => '1',
        'expected' => 1,
    ],
    'float' => [
        'input'    => '1.1',
        'expected' => 1.1,
    ],
    'bool' => [
        'input'    => 'true',
        'expected' => true,
    ],
    'null' => [
        'input'    => 'null',
        'expected' => null,
    ],
]);

test('decodes the json to an associative array', function () {
    $mutator = JsonDecode::assoc();

    expect($mutator->mutate('{"foo":"bar"}'))->toBe(['foo' => 'bar']);
});

test('decodes the json to an object', function () {
    $mutator = JsonDecode::object();

    expect($mutator->mutate('{"foo":"bar"}'))->toEqual((object)['foo' => 'bar']);
});

test('fails if given invalid json', function () {
    $mutator = JsonDecode::make();

    $mutator->mutate("\xB1\x31");
})->throws(JsonException::class);
