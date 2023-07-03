<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\String;

use ExeQue\Remix\Mutate\String\ReplaceLast;

test('replaces last occurrence of a string with another string', function () {
    $mutator = ReplaceLast::make('foo', 'bar');

    expect($mutator->mutate('foo foo foo'))->toBe('foo foo bar');
});

test('replaces nothing if search string is empty', function () {
    $mutator = ReplaceLast::make('', 'bar');

    expect($mutator->mutate('foo foo foo'))->toBe('foo foo foo');
});

test('replaces nothing if the search string was not found', function () {
    $mutator = ReplaceLast::make('bar', 'foo');

    expect($mutator->mutate('foo foo foo'))->toBe('foo foo foo');
});
