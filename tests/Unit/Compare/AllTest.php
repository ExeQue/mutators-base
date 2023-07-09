<?php

declare(strict_types=1);

namespace Tests\Unit\Compare;

use ExeQue\Remix\Compare\All;
use ExeQue\Remix\Exceptions\InvalidArgumentException;

it('checks if all comparators are truthful', function (array $comparators, bool $expected) {
    $comparator = All::make(...$comparators);

    expect($comparator->check(''))->toBe($expected);
})->with([
    'all true' => [
        'comparators' => [
            fn () => true,
            fn () => true,
            fn () => true,
            fn () => true,
        ],
        'expected' => true,
    ],
    'one false' => [
        'comparators' => [
            fn () => true,
            fn () => true,
            fn () => false,
            fn () => true,
        ],
        'expected' => false,
    ],
    'all false' => [
        'comparators' => [
            fn () => false,
            fn () => false,
            fn () => false,
            fn () => false,
        ],
        'expected' => false,
    ],
]);

it('throws an exception if no comparators are provided', function () {
    new All();
})->throws(InvalidArgumentException::class);
