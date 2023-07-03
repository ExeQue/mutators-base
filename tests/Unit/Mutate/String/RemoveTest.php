<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\String;

use ExeQue\Remix\Mutate\String\Remove;

test('removes all occurrences of a string', function () {
    $mutator = Remove::make('foo');

    expect($mutator->mutate('foo bar foo'))->toBe(' bar ');
});

test('removes all occurrences of a string regardless of casing', function () {
    $mutator = Remove::make('foo', false);

    expect($mutator->mutate('Foo bar FOO'))->toBe(' bar ');
});
