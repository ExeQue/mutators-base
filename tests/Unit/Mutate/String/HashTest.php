<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\String;

use ExeQue\Remix\Exceptions\InvalidArgumentException;
use ExeQue\Remix\Mutate\String\Hash;
use ReflectionClass;

it('hashes using built in algorithms', function (string $algorithm) {
    $mutator = Hash::make($algorithm);

    expect($mutator->mutate('foo'))->toBe(hash($algorithm, 'foo'));
})->with(hash_algos());

it('hashes using built in algorithms with raw output', function (string $algorithm) {
    $mutator = Hash::make($algorithm, true);

    expect($mutator->mutate('foo'))->not->toBe(hash($algorithm, 'foo'));
})->with(hash_algos());

it('fails if algorithm is not supported', function () {
    Hash::make('foo');
})->throws(InvalidArgumentException::class, 'Invalid hash algorithm provided. Got: "foo"');

it('matches named algorithm', function (Hash $mutator, string $algorithm) {
    $reflector = new ReflectionClass($mutator);
    $property  = $reflector->getProperty('algorithm');

    expect($property->getValue($mutator))->toBe($algorithm);
})->with([
    'crc32'  => fn () => [Hash::crc32(), 'crc32'],
    'md5'    => fn () => [Hash::md5(), 'md5'],
    'sha1'   => fn () => [Hash::sha1(), 'sha1'],
    'sha256' => fn () => [Hash::sha256(), 'sha256'],
    'sha512' => fn () => [Hash::sha512(), 'sha512'],
]);
