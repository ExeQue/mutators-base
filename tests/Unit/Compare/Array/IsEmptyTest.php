<?php

declare(strict_types=1);

namespace Tests\Unit\Compare\Array;

use ArrayIterator;
use ExeQue\Remix\Compare\Array\IsEmpty;

it('checks if a value is empty', function () {
    $comparator = IsEmpty::make();

    expect($comparator->check([]))->toBe(true);
});

it('checks if a value is not empty', function () {
    $comparator = IsEmpty::make();

    expect($comparator->check([1, 2, 3]))->toBe(false);
});

it('works with iterable objects', function () {
    $comparator = IsEmpty::make();

    expect($comparator->check(new ArrayIterator([])))->toBe(true);
});
