<?php

declare(strict_types=1);

namespace Tests\Unit\Serialize;

use ExeQue\Remix\Assert;
use ExeQue\Remix\Serialize\Serializer;
use stdClass;

it('encode method serializes a value', function () {
    $serializer = Serializer::make();

    expect($serializer->encode('foo'))->toBe('s:3:"foo";');
});

it('decode method deserializes a value', function () {
    $serializer = Serializer::make();

    expect($serializer->decode('s:3:"foo";'))->toBe('foo');
});

it('value remains unchanged when encoding and decoding', function () {
    $serializer = Serializer::make();

    $input = 'foo';

    expect($serializer->decode($serializer->encode($input)))->toBe($input);
});

it('only allows deserialization of allowed classes', function () {
    $serializer = Serializer::make([
        'allowed_classes' => [
            Assert::class,
        ],
    ]);

    $input = new stdClass();

    expect($serializer->decode($serializer->encode($input)))->not->toEqual($input);
});
