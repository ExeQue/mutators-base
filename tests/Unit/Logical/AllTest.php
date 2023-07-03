<?php

declare(strict_types=1);

namespace Tests\Unit\Logical;

use ExeQue\Mutators\Exceptions\InvalidArgumentException;
use ExeQue\Mutators\Logical\All;

test('all comparators must be truthful', function () {
    $comparator = All::make(
        fn () => true,
        fn () => true,
        fn () => true,
        fn () => true,
    );

    expect($comparator->mutate(''))->toBeTrue();
});

test('outputs false if any comparator is false', function () {
    $comparator = All::make(
        fn () => true,
        fn () => true,
        fn () => false,
        fn () => true,
    );

    expect($comparator->mutate(''))->toBeFalse();
});

test('outputs false if all comparators are false', function () {
    $comparator = All::make(
        fn () => false,
        fn () => false,
        fn () => false,
        fn () => false,
    );

    expect($comparator->mutate(''))->toBeFalse();
});

test('fails if comparators is empty', function () {
    new All();
})->throws(InvalidArgumentException::class);
