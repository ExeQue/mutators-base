<?php

declare(strict_types=1);

namespace Tests\Unit\Compare\Logical;

use ExeQue\Remix\Compare\Logical\All;
use ExeQue\Remix\Exceptions\InvalidArgumentException;

it('all comparators must be truthful', function () {
    $comparator = All::make(
        fn () => true,
        fn () => true,
        fn () => true,
        fn () => true,
    );

    expect($comparator->check(''))->toBeTrue();
});

it('outputs false if any comparator is false', function () {
    $comparator = All::make(
        fn () => true,
        fn () => true,
        fn () => false,
        fn () => true,
    );

    expect($comparator->check(''))->toBeFalse();
});

it('outputs false if all comparators are false', function () {
    $comparator = All::make(
        fn () => false,
        fn () => false,
        fn () => false,
        fn () => false,
    );

    expect($comparator->check(''))->toBeFalse();
});

it('fails if comparators is empty', function () {
    new All();
})->throws(InvalidArgumentException::class);
