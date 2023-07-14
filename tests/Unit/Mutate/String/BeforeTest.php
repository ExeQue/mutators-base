<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\String;

use ExeQue\Remix\Exceptions\InvalidArgumentException;
use ExeQue\Remix\Mutate\String\Before;

it('retrieves the part of the string before the occurrence of the search string', function (mixed $search, bool $last, mixed $input, mixed $expected) {
    $mutator = Before::make($search, $last);

    expect($mutator->mutate($input))->toBe($expected);
})->with([
    'first' => [
        'search'   => 'there',
        'last'     => false,
        'input'    => 'Hello there, General Kenobi. Hello there, Mr. Anderson',
        'expected' => 'Hello ',
    ],
    'last' => [
        'search'   => 'there',
        'last'     => true,
        'input'    => 'Hello there, General Kenobi. Hello there, Mr. Anderson',
        'expected' => 'Hello there, General Kenobi. Hello ',
    ],
    'not found' => [
        'search'   => 'not found',
        'last'     => false,
        'input'    => 'Hello there, General Kenobi. Hello there, Mr. Anderson',
        'expected' => 'Hello there, General Kenobi. Hello there, Mr. Anderson',
    ],
    'stringable input' => [
        'search' => 'there',
        'last'   => false,
        'input'  => new class () {
            public function __toString(): string
            {
                return 'Hello there, General Kenobi. Hello there, Mr. Anderson';
            }
        },
        'expected' => 'Hello ',
    ],
]);

test('aliases are identical to the original', function () {
    expect(Before::first('foo'))->toEqual(Before::make('foo'))
        ->and(Before::last('foo'))->toEqual(Before::make('foo', true));
});

it('throws an exception if given a non-stringable input', function () {
    Before::make('foo')->mutate([]);
})->throws(InvalidArgumentException::class);
