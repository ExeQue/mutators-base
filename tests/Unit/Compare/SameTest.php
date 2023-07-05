<?php

declare(strict_types=1);

namespace Tests\Unit\Compare;

use ExeQue\Remix\Compare\Same;
use stdClass;

it('values are identical', function ($one, $two) {
    $comparator = Same::make($one);

    expect($comparator->check($two))->toBe(true);
})->with([
    [1, 1],
    [[1], [1]],
]);

it('values are not identical', function ($one, $two) {
    $comparator = Same::make($one);

    expect($comparator->check($two))->toBe(false);
})->with([
    [1, 2],
    [1, '1'],
    [1, true],
    [1, false],
    [1, null],
    [1, []],
    [1, new stdClass()],
    [1, fopen('php://memory', 'rb')],
]);
