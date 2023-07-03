<?php

declare(strict_types=1);

namespace Tests\Unit\Logical;

use ExeQue\Mutators\Exceptions\InvalidArgumentException;
use ExeQue\Mutators\Logical\Any;

test('at least one comparator must be truthful', function () {
    $comparator = Any::make(
        fn () => false,
        fn () => false,
        fn () => false,
        fn () => true,
    );

    expect($comparator->mutate(''))->toBeTrue();
});

test('outputs false if all comparators are false', function () {
    $comparator = Any::make(
        fn () => false,
        fn () => false,
        fn () => false,
        fn () => false,
    );

    expect($comparator->mutate(''))->toBeFalse();
});

test('fails if comparators is empty', function () {
    new Any();
})->throws(InvalidArgumentException::class);
