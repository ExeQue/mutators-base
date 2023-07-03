<?php

declare(strict_types=1);

namespace Tests\Unit\String;

use ExeQue\Mutators\String\ReplaceFirst;

test('replaces first occurrence of a string with another string', function () {
    $mutator = ReplaceFirst::make('foo', 'bar');

    expect($mutator->mutate('foo foo foo'))->toBe('bar foo foo');
});

test('replaces nothing if search string is empty', function () {
    $mutator = ReplaceFirst::make('', 'bar');

    expect($mutator->mutate('foo foo foo'))->toBe('foo foo foo');
});

test('replaces nothing if the search string was not found', function () {
    $mutator = ReplaceFirst::make('bar', 'foo');

    expect($mutator->mutate('foo foo foo'))->toBe('foo foo foo');
});
