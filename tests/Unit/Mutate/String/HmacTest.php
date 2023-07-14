<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\String;

use ExeQue\Remix\Exceptions\InvalidArgumentException;
use ExeQue\Remix\Mutate\String\Hmac;

it('generates keyed hash', function () {
    $mutator = Hmac::make('sha1', 'foobar');

    expect($mutator->mutate('bazqux'))->toBe('c2b3788cbb11b293cda079478e80fab2c76edc81');
});

it('generates keyed hash with raw output', function () {
    $mutator = Hmac::make('sha1', 'foobar', true);

    expect($mutator->mutate('bazqux'))->not->toBe('c2b3788cbb11b293cda079478e80fab2c76edc81');
});

it('throws an exception if algorithm is not supported', function () {
    Hmac::make('foo', 'bar');
})->throws(InvalidArgumentException::class, 'Invalid hash algorithm provided. Got: "foo"');
