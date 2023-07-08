<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\String;

use ExeQue\Remix\Mutate\String\Replace;

it('replaces all occurrences of a string with another string', function () {
    $mutator = Replace::make('foo', 'bar');

    expect($mutator->mutate('foo foo foo'))->toBe('bar bar bar');
});

it('replaces all occurrences of a string with another regardless of casing', function () {
    $mutator = Replace::make('foo', 'bar', false);

    expect($mutator->mutate('Foo foo FOO'))->toBe('bar bar bar');
});

it('replaces all occurrences of a string with another string using case-sensitive alias', function () {
    $mutator = Replace::sensitive('foo', 'bar');

    expect($mutator->mutate('foo foo foo'))->toBe('bar bar bar')
        ->and($mutator->mutate('Foo foo FOO'))->toBe('Foo bar FOO');
});

it('replaces all occurrences of a string with another string using case-insensitive alias', function () {
    $mutator = Replace::insensitive('foo', 'bar');

    expect($mutator->mutate('foo foo foo'))->toBe('bar bar bar')
        ->and($mutator->mutate('Foo foo FOO'))->toBe('bar bar bar');
});
