<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\String;

use ExeQue\Remix\Mutate\String\Wrap;

test('wraps a string with both prefix and suffix', function () {
    $mutator = Wrap::make('foo', 'bar');

    expect($mutator->mutate('baz'))->toBe('foobazbar');
});

test('uses prefix as suffix if suffix is null', function () {
    $mutator = Wrap::make('foo');

    expect($mutator->mutate('baz'))->toBe('foobazfoo');
});
