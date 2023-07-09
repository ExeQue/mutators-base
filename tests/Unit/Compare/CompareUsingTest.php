<?php

declare(strict_types=1);

namespace Tests\Unit\Compare;

use ExeQue\Remix\Compare\ComparesUsing;

it('call the callback when mutating', function () {
    $comparator = ComparesUsing::make(function ($value) {
        return $value . 'bar';
    });

    expect($comparator->check('foo'))->toBe(true);
});

it('calls the callback when mutating', function () {
    $callCount = 0;

    $comparator = ComparesUsing::make(function ($value) use (&$callCount) {
        $callCount++;

        return $value . 'bar';
    });

    expect($comparator->check('foo'))->toBe(true)
        ->and($callCount)->toBe(1);
});
