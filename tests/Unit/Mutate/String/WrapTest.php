<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\String;

use ExeQue\Remix\Exceptions\InvalidArgumentException;
use ExeQue\Remix\Mutate\String\Wrap;

it('wraps a string with a prefix and/or suffix', function (mixed $before, mixed $after, mixed $input, mixed $expected) {
    $mutator = Wrap::make($before, $after);

    expect($mutator->mutate($input))->toBe($expected);
})->with([
    'prefix only' => [
        'before'   => 'foo',
        'after'    => '',
        'input'    => 'bar',
        'expected' => 'foobar',
    ],
    'suffix only' => [
        'before'   => '',
        'after'    => 'bar',
        'input'    => 'foo',
        'expected' => 'foobar',
    ],
    'prefix and suffix' => [
        'before'   => 'foo',
        'after'    => 'bar',
        'input'    => 'baz',
        'expected' => 'foobazbar',
    ],
    'same prefix and suffix when suffix is `null`' => [
        'before'   => 'foo',
        'after'    => null,
        'input'    => 'bar',
        'expected' => 'foobarfoo',
    ],
    'using stringable input' => [
        'before' => 'foo',
        'after'  => 'bar',
        'input'  => new class () {
            public function __toString(): string
            {
                return 'baz';
            }
        },
        'expected' => 'foobazbar',
    ],
]);



it('throws an exception when given a non-stringable input', function () {
    $mutator = Wrap::make('1');

    $mutator->mutate([]);
})->throws(InvalidArgumentException::class);
