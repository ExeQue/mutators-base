<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\Serialization;

use ExeQue\Remix\Exceptions\InvalidArgumentException;
use ExeQue\Remix\Mutate\Serialization\Base64Decode;

it('decodes valid base64 encoded string', function () {
    $mutator = Base64Decode::make();

    expect($mutator->mutate('Zm9v'))->toBe('foo');
});

it('throws exception when decoding invalid base64 encoded string while strict', function () {
    $mutator = Base64Decode::make();

    $mutator->mutate('æøå');
})->throws(InvalidArgumentException::class);

it('returns empty string when decoding invalid base64 encoded string while not strict', function () {
    $mutator = Base64Decode::make(false);

    expect($mutator->mutate('æøå'))->toBe('');
});
