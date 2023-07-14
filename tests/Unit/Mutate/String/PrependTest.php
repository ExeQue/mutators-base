<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\String;

use ExeQue\Remix\Exceptions\InvalidArgumentException;
use ExeQue\Remix\Mutate\String\Prepend;

it('prepends a string to the start of a string', function (mixed $prepend, mixed $input, mixed $expected) {
    $mutator = Prepend::make($prepend);

    expect($mutator->mutate($input))->toBe($expected);
})->with([
    'string' => [
        'prepend'  => 'bar',
        'input'    => 'foo',
        'expected' => 'barfoo',
    ],
    'stringable input' => [
        'prepend' => 'bar',
        'input'   => new class () {
            public function __toString(): string
            {
                return 'foo';
            }
        },
        'expected' => 'barfoo',
    ],
]);

it('throws an exception if given a non-stringable input', function () {
    Prepend::make('foo')->mutate([]);
})->throws(InvalidArgumentException::class);
