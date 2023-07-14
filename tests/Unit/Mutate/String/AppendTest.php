<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\String;

use ExeQue\Remix\Exceptions\InvalidArgumentException;
use ExeQue\Remix\Mutate\String\Append;

it('appends a string to the end of a string', function (mixed $append, mixed $input, mixed $expected) {
    $mutator = Append::make($append);

    expect($mutator->mutate($input))->toBe($expected);
})->with([
    'string' => [
        'append'   => 'bar',
        'input'    => 'foo',
        'expected' => 'foobar',
    ],
    'stringable input' => [
        'append' => 'bar',
        'input'  => new class () {
            public function __toString(): string
            {
                return 'foo';
            }
        },
        'expected' => 'foobar',
    ],
]);

it('throws an exception if given a non-stringable input', function () {
    Append::make('foo')->mutate([]);
})->throws(InvalidArgumentException::class);
