<?php

declare(strict_types=1);

namespace Tests\Unit\Compare\String;

use ExeQue\Remix\Compare\String\Contains;
use ExeQue\Remix\Exceptions\InvalidArgumentException;

it('checks if the string contains the value', function (string|array $search, bool $caseSensitive, bool $all, mixed $input, bool $expected) {
    $comparator = Contains::make($search, $caseSensitive, $all);

    expect($comparator->check($input))->toBe($expected);
})->with([
    'contains' => [
        'search'        => 'foo',
        'caseSensitive' => true,
        'all'           => false,
        'input'         => 'foo',
        'expected'      => true,
    ],
    'does not contain' => [
        'search'        => 'foo',
        'caseSensitive' => true,
        'all'           => false,
        'input'         => 'bar',
        'expected'      => false,
    ],
    'contains all' => [
        'search'        => ['f', 'o'],
        'caseSensitive' => true,
        'all'           => true,
        'input'         => 'foo',
        'expected'      => true,
    ],
    'does not contain all' => [
        'search'        => ['f', 'o', 'b'],
        'caseSensitive' => true,
        'all'           => true,
        'input'         => 'foo',
        'expected'      => false,
    ],
    'contains all regardless of casing' => [
        'search'        => ['O', 'F'],
        'caseSensitive' => false,
        'all'           => true,
        'input'         => 'foo',
        'expected'      => true,
    ],
    'does not contain all regardless of casing' => [
        'search'        => ['B', 'Q'],
        'caseSensitive' => false,
        'all'           => true,
        'input'         => 'foo',
        'expected'      => false,
    ],
    'contains any' => [
        'search'        => ['f', 'o'],
        'caseSensitive' => true,
        'all'           => false,
        'input'         => 'foo',
        'expected'      => true,
    ],
    'does not contain any' => [
        'search'        => ['b', 'a', 'z'],
        'caseSensitive' => true,
        'all'           => false,
        'input'         => 'foo',
        'expected'      => false,
    ],
    'contains any regardless of casing' => [
        'search'        => ['O', 'F'],
        'caseSensitive' => false,
        'all'           => false,
        'input'         => 'foo',
        'expected'      => true,
    ],
    'does not contain any regardless of casing' => [
        'search'        => ['B', 'Q'],
        'caseSensitive' => false,
        'all'           => false,
        'input'         => 'foo',
        'expected'      => false,
    ],
]);

it('does not throw an exception if given a stringable input', function (mixed $input) {
    Contains::make('foo')->check($input);
})->throwsNoExceptions()->with([
    'string' => [
        'input' => 'foo',
    ],
    'stringable' => [
        'input' => new class
        {
            public function __toString(): string
            {
                return 'foo';
            }
        },
    ],
]);

it('throws an exception if given any non-stringable input', function (array $input) {
    Contains::make('foo')->check($input);
})->throws(InvalidArgumentException::class)->with([
    'array' => [
        'input' => [[]],
    ],
    'object' => [
        'input' => [new class
        {
        }],
    ],
]);

test('aliases are identical to the original', function () {
    $all = Contains::make('foo');
    $allAlias = Contains::all('foo');

    expect($all)->toEqual($allAlias);

    $any = Contains::make('foo', all: false);
    $anyAlias = Contains::any('foo');

    expect($any)->toEqual($anyAlias);
});
