<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\String;

use ExeQue\Remix\Exceptions\InvalidArgumentException;
use ExeQue\Remix\Mutate\String\PositionOf;

it('gets the position of a string', function (mixed $needle, bool $last, int $offset, bool $caseSensitive, mixed $input, mixed $expected) {
    $mutator = PositionOf::make($needle, $last, $offset, $caseSensitive);

    expect($mutator->mutate($input))->toBe($expected);
})->with([
    'first occurrence' => [
        'needle'        => 'foo',
        'last'          => false,
        'offset'        => 0,
        'caseSensitive' => true,
        'input'         => 'foo bar baz foo bar baz',
        'expected'      => 0,
    ],
    'first occurrence with offset' => [
        'needle'        => 'foo',
        'last'          => false,
        'offset'        => 9,
        'caseSensitive' => true,
        'input'         => 'foo bar baz foo bar baz',
        'expected'      => 12,
    ],
    'last occurrence' => [
        'needle'        => 'foo',
        'last'          => true,
        'offset'        => 0,
        'caseSensitive' => true,
        'input'         => 'foo bar baz foo bar baz',
        'expected'      => 12,
    ],
    'last occurrence with offset' => [
        'needle'        => 'foo',
        'last'          => true,
        'offset'        => 15,
        'caseSensitive' => true,
        'input'         => 'foo bar baz foo bar baz',
        'expected'      => 0,
    ],
    'not found' => [
        'needle'        => 'not found',
        'last'          => false,
        'offset'        => 0,
        'caseSensitive' => true,
        'input'         => 'foo bar baz foo bar baz',
        'expected'      => false,
    ],
    'first with case insensitive' => [
        'needle'        => 'FOO',
        'last'          => false,
        'offset'        => 0,
        'caseSensitive' => false,
        'input'         => 'foo bar baz foo bar baz',
        'expected'      => 0,
    ],
    'last with case insensitive' => [
        'needle'        => 'FOO',
        'last'          => true,
        'offset'        => 0,
        'caseSensitive' => false,
        'input'         => 'foo bar baz foo bar baz',
        'expected'      => 12,
    ],
]);

test('aliases are identical to the original', function () {
    expect(PositionOf::first('foo'))->toEqual(PositionOf::make('foo'))
        ->and(PositionOf::last('foo'))->toEqual(PositionOf::make('foo', true));
});

it('throws an exception if given a non-stringable input', function () {
    PositionOf::make('foo')->mutate([]);
})->throws(InvalidArgumentException::class);
