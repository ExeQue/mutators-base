<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\String;

use ExeQue\Remix\Exceptions\InvalidArgumentException;
use ExeQue\Remix\Mutate\String\ReplaceFirst;

it('replaces the first occurrence of a string', function (mixed $search, mixed $replace, mixed $caseSensitive, mixed $input, mixed $expected) {
    $mutator = ReplaceFirst::make($search, $replace, $caseSensitive);

    expect($mutator->mutate($input))->toBe($expected);
})->with([
    'string' => [
        'search'        => 'foo',
        'replace'       => 'bar',
        'caseSensitive' => true,
        'input'         => 'foo foo foo',
        'expected'      => 'bar foo foo',
    ],
    'string with case insensitive' => [
        'search'        => 'FOO',
        'replace'       => 'bar',
        'caseSensitive' => false,
        'input'         => 'Foo foo FOO',
        'expected'      => 'bar foo FOO',
    ],
    'stringable input' => [
        'search'        => 'foo',
        'replace'       => 'bar',
        'caseSensitive' => true,
        'input'         => new class () {
            public function __toString(): string
            {
                return 'foo foo foo';
            }
        },
        'expected' => 'bar foo foo',
    ],
    'nothing if search is empty' => [
        'search'        => '',
        'replace'       => 'bar',
        'caseSensitive' => true,
        'input'         => 'foo foo foo',
        'expected'      => 'foo foo foo',
    ],
    'nothing if search is not found' => [
        'search'        => 'bar',
        'replace'       => 'baz',
        'caseSensitive' => true,
        'input'         => 'foo foo foo',
        'expected'      => 'foo foo foo',
    ],
]);

it('throws an exception if given a non-stringable input', function () {
    ReplaceFirst::make('foo', 'bar')->mutate([]);
})->throws(InvalidArgumentException::class);
