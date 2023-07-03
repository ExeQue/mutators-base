<?php

declare(strict_types=1);

namespace Tests\Unit\String;

use ExeQue\Mutators\String\Contains;

test('tests if string contains the search string', function () {
    $mutator = Contains::make('foo');

    expect($mutator->mutate('foo bar'))->toBeTrue()
        ->and($mutator->mutate('bar'))->toBeFalse()
        ->and($mutator->mutate('bar foo'))->toBeTrue();
});

test('tests if string contains the search string regardless of casing', function () {
    $mutator = Contains::make('foo', false);

    expect($mutator->mutate('foO bar'))->toBeTrue()
        ->and($mutator->mutate('bar'))->toBeFalse()
        ->and($mutator->mutate('bar fOO'))->toBeTrue()
        ->and($mutator->mutate('FOO'))->toBeTrue();
});

test('test if multibyte string contains another multibyte string', function () {
    $mutator = Contains::make('æøå');

    expect($mutator->mutate('æøå bar'))->toBeTrue()
        ->and($mutator->mutate('bar'))->toBeFalse()
        ->and($mutator->mutate('bar æøå'))->toBeTrue();
});

test('test if multibyte string contains another multibyte string regardless of casing', function () {
    $mutator = Contains::make('æøå', false);

    expect($mutator->mutate('æøÅ bar'))->toBeTrue()
        ->and($mutator->mutate('bar'))->toBeFalse()
        ->and($mutator->mutate('bar Æøå'))->toBeTrue()
        ->and($mutator->mutate('ÆØÅ'))->toBeTrue();
});
