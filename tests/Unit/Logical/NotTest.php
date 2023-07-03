<?php

declare(strict_types=1);

namespace Tests\Unit\Logical;

use ExeQue\Mutators\Logical\Not;

test('inverts comparator', function (mixed $comparator, mixed $expected) {
    $comparator = Not::make($comparator);

    expect($comparator->mutate('foo'))->toBe($expected);
})->with(function () {
    return [
        'callable mutator' => [
            'comparator' => fn () => true,
            'expected'   => false,
        ],
        'boolean' => [
            'comparator' => true,
            'expected'   => false,
        ],
    ];
});
