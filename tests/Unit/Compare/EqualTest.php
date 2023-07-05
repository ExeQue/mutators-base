<?php

declare(strict_types=1);

namespace Tests\Unit\Compare;

use ExeQue\Remix\Compare\Equal;

it('values are equal', function ($one, $two) {
    $comparator = Equal::make($one);

    expect($comparator->check($two))->toBe(true);
})->with([
    [1, 1],
    [1, '1'],
    [1, true],
    [1.2, '1.2'],
    [0, false],
    [0, null],
    ['', null],
    [[], []],
    [[1], ['1']],
]);
