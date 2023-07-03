<?php

declare(strict_types=1);

namespace Tests\Unit\Compare\Logical;

use ExeQue\Remix\Compare\Logical\Any;
use ExeQue\Remix\Exceptions\InvalidArgumentException;

test('at least one comparator must be truthful', function () {
    $comparator = Any::make(
        fn () => false,
        fn () => false,
        fn () => false,
        fn () => true,
    );

    expect($comparator->check(''))->toBeTrue();
});

test('outputs false if all comparators are false', function () {
    $comparator = Any::make(
        fn () => false,
        fn () => false,
        fn () => false,
        fn () => false,
    );

    expect($comparator->check(''))->toBeFalse();
});

test('fails if comparators is empty', function () {
    new Any();
})->throws(InvalidArgumentException::class);
