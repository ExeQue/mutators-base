<?php

declare(strict_types=1);

namespace Tests\Unit\Compare\Array;

use ArrayIterator;
use ExeQue\Remix\Compare\Array\IsMap;

it('checks if a value is a map', function () {
    $comparator = IsMap::make();

    expect($comparator->check(['foo' => 'bar']))->toBe(true);
});

it('checks if a value is not a map', function () {
    $comparator = IsMap::make();

    expect($comparator->check([1, 2, 3]))->toBe(false);
});

it('works with iterable objects', function () {
    $comparator = IsMap::make();

    expect($comparator->check(new ArrayIterator(['foo' => 'bar'])))->toBe(true);
});
