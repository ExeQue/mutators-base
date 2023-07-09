<?php

declare(strict_types=1);

namespace Tests\Unit\Compare\Array;

use ArrayIterator;
use ExeQue\Remix\Compare\Array\IsEmpty;

it('checks if a value is empty', function (mixed $input, bool $expected) {
    $comparator = IsEmpty::make();

    expect($comparator->check($input))->toBe($expected);
})->with([
    'empty array' => [
        'input'    => [],
        'expected' => true,
    ],
    'empty string' => [
        'input'    => '',
        'expected' => true,
    ],
    'empty iterable' => [
        'input'    => new ArrayIterator([]),
        'expected' => true,
    ],
    'non-empty array' => [
        'input'    => [1, 2, 3],
        'expected' => false,
    ],
    'non-empty string' => [
        'input'    => 'foo',
        'expected' => false,
    ],
    'non-empty object' => [
        'input'    => new ArrayIterator([1, 2, 3]),
        'expected' => false,
    ],
    'non-empty iterable' => [
        'input'    => new ArrayIterator([1, 2, 3]),
        'expected' => false,
    ],
]);
