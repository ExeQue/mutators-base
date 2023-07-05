<?php

declare(strict_types=1);

namespace Tests\Unit\Compare\String;

use ExeQue\Remix\Compare\String\Contains;

it('tests if string contains the search string', function () {
    $mutator = Contains::make('foo');

    expect($mutator->check('foo bar'))->toBeTrue()
        ->and($mutator->check('bar'))->toBeFalse()
        ->and($mutator->check('bar foo'))->toBeTrue();
});

it('tests if string contains the search string regardless of casing', function () {
    $mutator = Contains::make('foo', false);

    expect($mutator->check('foO bar'))->toBeTrue()
        ->and($mutator->check('bar'))->toBeFalse()
        ->and($mutator->check('bar fOO'))->toBeTrue()
        ->and($mutator->check('FOO'))->toBeTrue();
});

it('test if multibyte string contains another multibyte string', function () {
    $mutator = Contains::make('æøå');

    expect($mutator->check('æøå bar'))->toBeTrue()
        ->and($mutator->check('bar'))->toBeFalse()
        ->and($mutator->check('bar æøå'))->toBeTrue();
});

it('test if multibyte string contains another multibyte string regardless of casing', function () {
    $mutator = Contains::make('æøå', false);

    expect($mutator->check('æøÅ bar'))->toBeTrue()
        ->and($mutator->check('bar'))->toBeFalse()
        ->and($mutator->check('bar Æøå'))->toBeTrue()
        ->and($mutator->check('ÆØÅ'))->toBeTrue();
});
