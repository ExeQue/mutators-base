<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\Serialization;

use ArrayIterator;
use ExeQue\Remix\Exceptions\SerializeException;
use ExeQue\Remix\Mutate\Serialization\Serialize;
use Tests\Fixtures\UnserializableFixture;

it('serialize a value', function (mixed $input, string $expected) {
    $serializer = Serialize::make();

    expect($serializer->mutate($input))->toBe($expected);
})->with([
    'string' => [
        'input'    => 'foo',
        'expected' => 's:3:"foo";',
    ],
    'integer' => [
        'input'    => 42,
        'expected' => 'i:42;',
    ],
    'float' => [
        'input'    => 42.42,
        'expected' => 'd:42.42;',
    ],
    'array' => [
        'input'    => ['foo', 'bar'],
        'expected' => 'a:2:{i:0;s:3:"foo";i:1;s:3:"bar";}',
    ],
    'object' => [
        'input'    => (object)['foo' => 'bar'],
        'expected' => 'O:8:"stdClass":1:{s:3:"foo";s:3:"bar";}',
    ],
    'null' => [
        'input'    => null,
        'expected' => 'N;',
    ],
    'boolean' => [
        'input'    => true,
        'expected' => 'b:1;',
    ],
    'resource' => [
        'input'    => fopen('php://memory', 'rb'),
        'expected' => 'i:0;',
    ],
    'class' => [
        'input'    => new ArrayIterator(['foo', 'bar']),
        'expected' => 'O:13:"ArrayIterator":4:{i:0;i:0;i:1;a:2:{i:0;s:3:"foo";i:1;s:3:"bar";}i:2;a:0:{}i:3;N;}',
    ],
    'array of objects' => [
        'input'    => [(object)['foo' => 'bar']],
        'expected' => 'a:1:{i:0;O:8:"stdClass":1:{s:3:"foo";s:3:"bar";}}',
    ],
]);

it('throws an exception if unable to serialize', function (mixed $input) {
    $serializer = Serialize::make();

    $serializer->mutate($input);
})->throws(SerializeException::class)->with([
    'callable' => [
        'input' => fn () => function () {
        },
    ],
    'anonymous class' => [
        'input' => new class
        {
        },
    ],
    'class with exception during __serialize' => [
        'input' => new UnserializableFixture(),
    ],
]);
