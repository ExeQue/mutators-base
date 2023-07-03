<?php

declare(strict_types=1);

namespace Tests\Unit\Logical;

use ExeQue\Mutators\Logical\One;

test('only one comparator can be true', function (array $comparators, bool $expected) {
    $comparator = One::make(...$comparators);

    expect($comparator->mutate(''))->toBe($expected);
})->with([
    'one true (true)' => [
        [
            fn () => false,
            fn () => false,
            fn () => true,
            fn () => false,
        ],
        true,
    ],
    'multiple true (false)' => [
        [
            fn () => true,
            fn () => true,
            fn () => true,
            fn () => true,
        ],
        false,
    ],
    'no true (false)' => [
        [
            fn () => false,
            fn () => false,
            fn () => false,
            fn () => false,
        ],
        false,
    ],
]);
