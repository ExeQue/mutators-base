<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\Array;

use ArrayIterator;
use ExeQue\Remix\Mutate\Array\Keys;

it('gets the keys from an array', function (mixed $input, mixed $expected) {
    $mutator = Keys::make();

    expect($mutator->mutate($input))->toBe($expected);
})->with([
    'associative array' => [
        'input'    => ['foo' => 2, 'bar' => 4, 'baz' => 6],
        'expected' => ['foo', 'bar', 'baz'],
    ],
    'numeric array' => [
        'input'    => ['foo', 'bar', 'baz'],
        'expected' => [0, 1, 2],
    ],
    'iterator' => [
        'input'    => new ArrayIterator(['foo' => 2, 'bar' => 4, 'baz' => 6]),
        'expected' => ['foo', 'bar', 'baz'],
    ],
]);
