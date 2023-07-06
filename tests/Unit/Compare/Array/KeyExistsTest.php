<?php

declare(strict_types=1);

namespace Tests\Unit\Compare\Array;

// Create tests for the following class: \ExeQue\Remix\Compare\Array\KeyExists

use ExeQue\Remix\Compare\Array\KeyExists;

test('has a key', function () {
    $comparator = KeyExists::make('foo');

    expect($comparator->check(['foo' => 'bar']))->toBe(true);
});

test('does not have a key', function () {
    $comparator = KeyExists::make('foo');

    expect($comparator->check(['bar' => 'foo']))->toBe(false);
});

test('has a key with a null value', function () {
    $comparator = KeyExists::make('foo');

    expect($comparator->check(['foo' => null]))->toBe(true);
});

test('has a key with a false value', function () {
    $comparator = KeyExists::make('foo');

    expect($comparator->check(['foo' => false]))->toBe(true);
});

test('has a key with a zero value', function () {
    $comparator = KeyExists::make('foo');

    expect($comparator->check(['foo' => 0]))->toBe(true);
});

test('has a key with an empty string value', function () {
    $comparator = KeyExists::make('foo');

    expect($comparator->check(['foo' => '']))->toBe(true);
});

test('has a key with an empty array value', function () {
    $comparator = KeyExists::make('foo');

    expect($comparator->check(['foo' => []]))->toBe(true);
});

test('is case sensitive', function () {
    $comparator = KeyExists::make('foo');

    expect($comparator->check(['FOO' => 'bar']))->toBe(false);
});
