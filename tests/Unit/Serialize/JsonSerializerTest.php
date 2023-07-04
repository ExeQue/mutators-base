<?php

declare(strict_types=1);

namespace Tests\Unit\Serialize;

use ExeQue\Remix\Serialize\Json\JsonSerializer;

test('decode method returns decoded value', function () {
    $serializer = JsonSerializer::make();

    expect($serializer->decode('"foo"'))->toBe('foo');
});

test('encode method returns encoded value', function () {
    $serializer = JsonSerializer::make();

    expect($serializer->encode('foo'))->toBe('"foo"');
});

test('value remains unchanged when encoding and decoding', function ($input) {
    $serializer = JsonSerializer::make();

    expect($serializer->decode($serializer->encode($input)))->toBe($input);
})->with([
    'simple' => [
        'input' => ['foo' => 'bar'],
    ],
    'complex' => [
        'input' => ['foo' => ['bar' => 'baz']],
    ],
    'string' => [
        'input' => 'foo',
    ],
    'int' => [
        'input' => 1,
    ],
    'float' => [
        'input' => 1.1,
    ],
    'bool' => [
        'input' => true,
    ],
    'null' => [
        'input' => null,
    ],
]);

test('value remains comparable when decoding and encoding', function ($input, $expected) {
    $serializer = JsonSerializer::make();

    expect($serializer->encode($serializer->decode($input)))->toBe($expected);
})->with([
    'simple' => [
        'input'    => '{"foo":"bar"}',
        'expected' => '{"foo":"bar"}',
    ],
    'complex' => [
        'input'    => '{"foo":{"bar":"baz"}}',
        'expected' => '{"foo":{"bar":"baz"}}',
    ],
    'pretty' => [
        'input' => <<<'JSON'
{
    "foo": "bar"
}
JSON,
        'expected' => '{"foo":"bar"}',
    ],
    'string' => [
        'input'    => '"foo"',
        'expected' => '"foo"',
    ],
    'int' => [
        'input'    => '1',
        'expected' => '1',
    ],
    'float' => [
        'input'    => '1.1',
        'expected' => '1.1',
    ],
    'bool' => [
        'input'    => 'true',
        'expected' => 'true',
    ],
    'null' => [
        'input'    => 'null',
        'expected' => 'null',
    ],
]);
