<?php

declare(strict_types=1);

namespace Tests\Unit\Compare;

use ExeQue\Remix\Compare\One;

it('checks if only one comparator is true', function (array $comparators, bool $expected) {
    $comparator = One::make(...$comparators);

    expect($comparator->check(''))->toBe($expected);
})->with([
    'one true' => [
        'comparators' => [
            fn () => false,
            fn () => false,
            fn () => true,
            fn () => false,
        ],
        'expected' => true,
    ],
    'multiple true' => [
        'comparators' => [
            fn () => true,
            fn () => true,
            fn () => true,
            fn () => true,
        ],
        'expected' => false,
    ],
    'no true' => [
        'comparators' => [
            fn () => false,
            fn () => false,
            fn () => false,
            fn () => false,
        ],
        'expected' => false,
    ],
]);
