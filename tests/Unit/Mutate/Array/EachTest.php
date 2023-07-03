<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\Array;

use ExeQue\Remix\Mutate\Array\Each;

test('executes callback for each element in an array', function () {
    $counter = 0;
    $mutator = Each::make(function () use (&$counter) {
        $counter++;
    });

    $mutator->mutate(['foo', 'bar', 'baz']);

    expect($counter)->toBe(3);
});

test('does not modify the array', function () {
    $mutator = Each::make(function () {
    });

    $array = ['foo', 'bar', 'baz'];
    $mutator->mutate($array);

    expect($array)->toBe(['foo', 'bar', 'baz']);
});

test('breaks if callback returns false', function () {
    $counter = 0;
    $mutator = Each::make(function () use (&$counter) {
        $counter++;

        return false;
    });

    $mutator->mutate(['foo', 'bar', 'baz']);

    expect($counter)->toBe(1);
});

test('provides value and key to callback', function () {
    $mutator = Each::make(function ($value, $key) {
        expect($value)->toBe('foo')
            ->and($key)->toBe(0);
    });

    $mutator->mutate(['foo']);
});
