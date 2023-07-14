<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\String;

use ExeQue\Remix\Exceptions\InvalidArgumentException;
use ExeQue\Remix\Mutate\String\Remove;

it('removes all occurrences of a string', function (mixed $search, bool $caseSensitive, mixed $input, mixed $expected) {
    $mutator = Remove::make($search, $caseSensitive);

    expect($mutator->mutate($input))->toBe($expected);
})->with([
    'string' => [
        'search'        => 'foo',
        'caseSensitive' => true,
        'input'         => 'foo bar baz foo bar baz',
        'expected'      => ' bar baz  bar baz',
    ],
    'string with case insensitive' => [
        'search'        => 'FOO',
        'caseSensitive' => false,
        'input'         => 'Foo bar baz fOo bar baz',
        'expected'      => ' bar baz  bar baz',
    ],
    'stringable input' => [
        'search'        => 'foo',
        'caseSensitive' => true,
        'input'         => new class () {
            public function __toString(): string
            {
                return 'foo bar baz foo bar baz';
            }
        },
        'expected' => ' bar baz  bar baz',
    ],
]);

it('throws an exception if given a non-stringable input', function () {
    Remove::make('foo')->mutate([]);
})->throws(InvalidArgumentException::class);
