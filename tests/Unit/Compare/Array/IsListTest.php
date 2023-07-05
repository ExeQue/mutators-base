<?php

declare(strict_types=1);

namespace Tests\Unit\Compare\Array;

use ArrayIterator;
use ExeQue\Remix\Compare\Array\IsList;

it('checks if a value is a list', function () {
    $comparator = IsList::make();

    expect($comparator->check([1, 2, 3]))->toBe(true);
});

it('checks if a value is not a list', function () {
    $comparator = IsList::make();

    expect($comparator->check(['foo' => 'bar']))->toBe(false);
});

it('works with iterable objects', function () {
    $comparator = IsList::make();

    expect($comparator->check(new ArrayIterator([1, 2, 3])))->toBe(true);
});
