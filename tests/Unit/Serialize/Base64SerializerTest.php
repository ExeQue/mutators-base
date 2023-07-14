<?php

declare(strict_types=1);

namespace Tests\Unit\Serialize;

use ExeQue\Remix\Serialize\Base64Serializer;

use function Pest\Faker\fake;

it('decode method decodes a base64 string', function () {
    $serializer = Base64Serializer::make();

    expect($serializer->decode('Zm9v'))->toBe('foo');
});

it('encode method encodes a string to base64', function () {
    $serializer = Base64Serializer::make();

    expect($serializer->encode('foo'))->toBe('Zm9v');
});

it('decode method returns empty string when decoding invalid base64 encoded string while not strict', function () {
    $serializer = Base64Serializer::make(false);

    expect($serializer->decode('æøå'))->toBe('');
});

it('value remains unchanged when encoding and decoding', function () {
    $serializer = Base64Serializer::make();

    $input = fake()->sentence();

    expect($serializer->decode($serializer->encode($input)))->toBe($input);
});
