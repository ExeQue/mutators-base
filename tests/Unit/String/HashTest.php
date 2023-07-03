<?php

declare(strict_types=1);

namespace Tests\Unit\String;

use ExeQue\Mutators\Exceptions\InvalidArgumentException;
use ExeQue\Mutators\MutatorInterface;
use ExeQue\Mutators\String\Hash;
use ExeQue\Mutators\String\Hash\Crc32;
use ExeQue\Mutators\String\Hash\Md5;
use ExeQue\Mutators\String\Hash\Sha1;
use ExeQue\Mutators\String\Hash\Sha256;
use ExeQue\Mutators\String\Hash\Sha512;

test('hashes using built in algorithms', function (string $algorithm) {
    $mutator = Hash::make($algorithm);

    expect($mutator->mutate('foo'))->toBe(hash($algorithm, 'foo'));
})->with(hash_algos());

test('hashes using built in algorithms with raw output', function (string $algorithm) {
    $mutator = Hash::make($algorithm, true);

    expect($mutator->mutate('foo'))->not->toBe(hash($algorithm, 'foo'));
})->with(hash_algos());

test('fails if algorithm is not supported', function () {
    Hash::make('foo');
})->throws(InvalidArgumentException::class, 'Invalid hash algorithm provided. Got: "foo"');

test('alias matches named algorithm', function (string $class, string $algorithm) {
    $input = base64_encode(random_bytes(64));
    /** @var MutatorInterface $mutator */
    $mutator = new $class();

    expect($mutator->mutate($input))->toBe(hash($algorithm, $input));
})->with([
    Crc32::class  => [Crc32::class, 'crc32'],
    Md5::class    => [Md5::class, 'md5'],
    Sha1::class   => [Sha1::class, 'sha1'],
    Sha256::class => [Sha256::class, 'sha256'],
    Sha512::class => [Sha512::class, 'sha512'],
]);
