<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\Array;

use ArrayIterator;
use ExeQue\Remix\Mutate\Array\Flip;

it('flips keys and values', function (mixed $input, array $expected) {
    $mutator = Flip::make();

    expect($mutator->mutate($input))->toBe($expected);
})->with([
    'associative array' => [
        'input'    => ['foo' => 'bar', 'baz' => 'qux'],
        'expected' => ['bar' => 'foo', 'qux' => 'baz'],
    ],
    'numeric array' => [
        'input'    => ['foo', 'bar', 'baz'],
        'expected' => ['foo' => 0, 'bar' => 1, 'baz' => 2],
    ],
    'iterator' => [
        'input'    => new ArrayIterator(['foo' => 'bar', 'baz' => 'qux']),
        'expected' => ['bar' => 'foo', 'qux' => 'baz'],
    ],
]);
