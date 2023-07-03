<?php

declare(strict_types=1);

namespace Tests\Unit\String;

use ExeQue\Mutators\Exceptions\InvalidArgumentException;
use ExeQue\Mutators\String\Hmac;

test('generates keyed hash', function () {
    $mutator = Hmac::make('sha1', 'foobar');

    expect($mutator->mutate('bazqux'))->toBe(hash_hmac('sha1', 'bazqux', 'foobar'));
});

test('generates keyed hash with raw output', function () {
    $mutator = Hmac::make('sha1', 'foobar', true);

    expect($mutator->mutate('bazqux'))->not->toBe(hash_hmac('sha1', 'bazqux', 'foobar'));
});

test('fails if algorithm is not supported', function () {
    Hmac::make('foo', 'bar');
})->throws(InvalidArgumentException::class, 'Invalid hash algorithm provided. Got: "foo"');
