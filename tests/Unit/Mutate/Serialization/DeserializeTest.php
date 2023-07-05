<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\Serialization;

use ExeQue\Remix\Exceptions\SerializeException;
use ExeQue\Remix\Mutate\Serialization\Deserialize;
use stdClass;
use Webmozart\Assert\Assert;

it('deserialize a value', function (string $input, mixed $expected) {
    $mutator = Deserialize::make();

    expect($mutator->mutate($input))->toEqual($expected);
})->with([
    'string' => [
        'input'    => 's:11:"Hello there";',
        'expected' => 'Hello there',
    ],
    'integer' => [
        'input'    => 'i:42;',
        'expected' => 42,
    ],
    'float' => [
        'input'    => 'd:42.42;',
        'expected' => 42.42,
    ],
    'array' => [
        'input'    => 'a:2:{i:0;s:3:"foo";i:1;s:3:"bar";}',
        'expected' => ['foo', 'bar'],
    ],
    'object' => [
        'input'    => 'O:8:"stdClass":1:{s:3:"foo";s:3:"bar";}',
        'expected' => (object)['foo' => 'bar'],
    ],
    'null' => [
        'input'    => 'N;',
        'expected' => null,
    ],
    'boolean' => [
        'input'    => 'b:1;',
        'expected' => true,
    ],
    'array of objects' => [
        'input'    => 'a:1:{i:0;O:8:"stdClass":1:{s:3:"foo";s:3:"bar";}}',
        'expected' => [(object)['foo' => 'bar']],
    ],
]);

it('throws an exception if unable to deserialize', function (string $input) {
    $mutator = Deserialize::make();

    $mutator->mutate($input);
})->throws(SerializeException::class)->with([
    'invalid string' => [
        'input' => 's:12:"Hello there"',
    ],
    'invalid integer' => [
        'input' => 'i:42a',
    ],
    'invalid float' => [
        'input' => 'd:42.42a',
    ],
    'invalid array' => [
        'input' => 'a:2:{i:0;s:2:"foo";i:1;s:3:"bar"}',
    ],
    'invalid object' => [
        'input' => 'O:8:"stdClass":1:{s:3:"foo";s:3:"bar"}',
    ],
    'invalid boolean' => [
        'input' => 'b:1',
    ],
    'invalid resource' => [
        'input' => 'i:0',
    ],
    'invalid class' => [
        'input' => 'O:11:"ArrayIterator":4:{i:0;i:0;i:1;a:2:{i:0;s:3:"foo";i:1;s:3:"bar";}i:2;a:0:{}i:3;N;}',
    ],
    'invalid null' => [
        'input' => 'N',
    ],
    'invalid type' => [
        'input' => 'z:1;',
    ],
    'class with exception during __wakeup' => [
        'input' => 'O:38:"Tests\Fixtures\UnserializableFixture":0:{}',
    ],
]);

it('only allow certain classes to be deserialized', function () {
    $mutator = Deserialize::make([
        'allowed_classes' => [
            Assert::class,
        ],
    ]);

    expect($mutator->mutate('O:8:"stdClass":1:{s:3:"foo";s:3:"bar";}'))->not->toBeInstanceOf(stdClass::class);
});
