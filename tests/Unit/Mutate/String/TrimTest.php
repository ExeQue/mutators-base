<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\String;

use ExeQue\Remix\Data\StringDirection;
use ExeQue\Remix\Exceptions\InvalidArgumentException;
use ExeQue\Remix\Mutate\String\Trim;

it('trims a string', function (mixed $direction, mixed $characters, mixed $input, mixed $expected) {
    $mutator = Trim::make($direction, $characters);

    expect($mutator->mutate($input))->toBe($expected);
})->with([
    'trim whitespace left' => [
        'direction'  => StringDirection::Left,
        'characters' => null,
        'input'      => " \t\n\r\0\x0Bfoobar",
        'expected'   => 'foobar',
    ],
    'trim whitespace right' => [
        'direction'  => StringDirection::Right,
        'characters' => null,
        'input'      => "foobar \t\n\r\0\x0B",
        'expected'   => 'foobar',
    ],
    'trim whitespace both' => [
        'direction'  => StringDirection::Both,
        'characters' => null,
        'input'      => " \t\n\r\0\x0Bfoobar \t\n\r\0\x0B",
        'expected'   => 'foobar',
    ],
    'trim custom characters left' => [
        'direction'  => StringDirection::Left,
        'characters' => 'of',
        'input'      => 'foobar',
        'expected'   => 'bar',
    ],
    'trim custom characters right' => [
        'direction'  => StringDirection::Right,
        'characters' => 'rab',
        'input'      => 'foobar',
        'expected'   => 'foo',
    ],
    'trim custom characters both' => [
        'direction'  => StringDirection::Both,
        'characters' => 'fbar',
        'input'      => 'foobar',
        'expected'   => 'oo',
    ],
    'using stringable characters' => [
        'direction'  => StringDirection::Both,
        'characters' => null,
        'input'      => new class () {
            public function __toString(): string
            {
                return 'foobar';
            }
        },
        'expected' => 'foobar',
    ],
]);

test('aliases are identical to the original method', function () {
    expect(Trim::left())->toEqual(Trim::make(StringDirection::Left))
        ->and(Trim::right())->toEqual(Trim::make(StringDirection::Right))
        ->and(Trim::both())->toEqual(Trim::make());
});



it('throws an exception when given a non-stringable input', function () {
    $mutator = Trim::make();

    $mutator->mutate([]);
})->throws(InvalidArgumentException::class);
