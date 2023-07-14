<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\String;

use ExeQue\Remix\Exceptions\InvalidArgumentException;
use ExeQue\Remix\Mutate\String\Hash;

it('hashes using built in algorithms', function (string $algorithm) {
    $mutator = Hash::make($algorithm);

    expect($mutator->mutate('foo'))->toBe(hash($algorithm, 'foo'));
})->with(hash_algos());

it('hashes using built in algorithms with raw output', function (string $algorithm) {
    $mutator = Hash::make($algorithm, true);

    expect($mutator->mutate('foo'))->not->toBe(hash($algorithm, 'foo'));
})->with(hash_algos());

it('throws an exception if algorithm is not supported', function () {
    Hash::make('foo');
})->throws(InvalidArgumentException::class, 'Invalid hash algorithm provided. Got: "foo"');

test('aliases are identical to the original', function () {
    expect(Hash::md5())->toEqual(Hash::make('md5'))
        ->and(Hash::sha1())->toEqual(Hash::make('sha1'))
        ->and(Hash::sha256())->toEqual(Hash::make('sha256'))
        ->and(Hash::sha512())->toEqual(Hash::make('sha512'))
        ->and(Hash::crc32())->toEqual(Hash::make('crc32'));
});
