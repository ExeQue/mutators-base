<?php

declare(strict_types=1);

namespace Tests\Unit\Compare;

use ExeQue\Remix\Compare\Equal;

it('checks if values are equal', function(mixed $one, mixed $two, bool $expected) {
    $comparator = Equal::make($one);

    expect($comparator->check($two))->toBe($expected);
})->with([
    '1 and 2' => [
        'one'      => 1,
        'two'      => 2,
        'expected' => false,
    ],
    '1 and 1' => [
        'one'      => 1,
        'two'      => 1,
        'expected' => true,
    ],
    '1 and "1"' => [
        'one'      => 1,
        'two'      => '1',
        'expected' => true,
    ],
    '1 and true' => [
        'one'      => 1,
        'two'      => true,
        'expected' => true,
    ],
    '1.2 and "1.2"' => [
        'one'      => 1.2,
        'two'      => '1.2',
        'expected' => true,
    ],
    '0 and false' => [
        'one'      => 0,
        'two'      => false,
        'expected' => true,
    ],
    '0 and null' => [
        'one'      => 0,
        'two'      => null,
        'expected' => true,
    ],
    '"" and null' => [
        'one'      => '',
        'two'      => null,
        'expected' => true,
    ],
    '[] and []' => [
        'one'      => [],
        'two'      => [],
        'expected' => true,
    ],
    '[1] and ["1"]' => [
        'one'      => [1],
        'two'      => ['1'],
        'expected' => true,
    ],
]);
