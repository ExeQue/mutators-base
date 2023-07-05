<?php

declare(strict_types=1);

namespace Tests\Unit\Compare\Countable;

use ExeQue\Remix\Compare\Countable\CountEqual;
use ExeQue\Remix\Exceptions\InvalidArgumentException;

it('checks count is equal', function () {
    $comparator = CountEqual::make(3);

    expect($comparator->check([1, 2, 3]))->toBe(true);
});

it('fails if count is negative', function () {
    CountEqual::make(-1);
})->throws(InvalidArgumentException::class);
