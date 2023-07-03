<?php

declare(strict_types=1);

namespace Tests\Unit\String;

use ExeQue\Mutators\String\Replace;

test('replaces all occurrences of a string with another string', function () {
    $mutator = Replace::make('foo', 'bar');

    expect($mutator->mutate('foo foo foo'))->toBe('bar bar bar');
});

test('replaces all occurrences of a string with another regardless of casing', function () {
    $mutator = Replace::make('foo', 'bar', false);

    expect($mutator->mutate('Foo foo FOO'))->toBe('bar bar bar');
});
