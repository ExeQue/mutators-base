<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\Serialization;

use ExeQue\Remix\Exceptions\JsonException;
use ExeQue\Remix\Mutate\Serialization\JsonEncode;

test('encodes the value as json', function (mixed $input, string $expected) {
    $mutator = JsonEncode::make();

    expect($mutator->mutate($input))->toBe($expected);
})->with([
    'simple' => [
        'input'    => ['foo' => 'bar'],
        'expected' => '{"foo":"bar"}',
    ],
    'complex' => [
        'input'    => ['foo' => ['bar' => 'baz']],
        'expected' => '{"foo":{"bar":"baz"}}',
    ],
    'string' => [
        'input'    => 'foo',
        'expected' => '"foo"',
    ],
    'int' => [
        'input'    => 1,
        'expected' => '1',
    ],
    'float' => [
        'input'    => 1.1,
        'expected' => '1.1',
    ],
    'bool' => [
        'input'    => true,
        'expected' => 'true',
    ],
    'null' => [
        'input'    => null,
        'expected' => 'null',
    ],
]);

test('encode the value as json with pretty', function () {
    $mutator = JsonEncode::pretty();

    $expected = <<<'JSON'
{
    "foo": "bar"
}
JSON;

    expect($mutator->mutate(['foo' => 'bar']))->toBe($expected);
});

test('fails if given invalid json', function () {
    $mutator = JsonEncode::make();

    $mutator->mutate("\xB1\x31");
})->throws(JsonException::class);
