<?php

declare(strict_types=1);

namespace Tests\Unit\Compare;

use ExeQue\Remix\Compare\Any;
use ExeQue\Remix\Exceptions\InvalidArgumentException;

it('checks if at least one comparator is truthful', function (array $comparators, bool $expected) {
    $comparator = Any::make(...$comparators);

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
    'one true' => [
        'comparators' => [
            fn () => false,
            fn () => false,
            fn () => true,
            fn () => false,
        ],
        'expected' => true,
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

it('at least one comparator must be truthful', function () {
    $comparator = Any::make(
        fn () => false,
        fn () => false,
        fn () => false,
        fn () => true,
    );

    expect($comparator->check(''))->toBeTrue();
});

it('outputs false if all comparators are false', function () {
    $comparator = Any::make(
        fn () => false,
        fn () => false,
        fn () => false,
        fn () => false,
    );

    expect($comparator->check(''))->toBeFalse();
});

it('throws an exception if no comparators are provided', function () {
    new Any();
})->throws(InvalidArgumentException::class);
