<?php

declare(strict_types=1);

namespace Tests\Unit;

use ExeQue\Mutators\CallbackComparator;

test('call the callback when mutating', function () {
    $mutator = CallbackComparator::make(function ($value) {
        return $value . 'bar';
    });

    expect($mutator->mutate('foo'))->toBe(true);
})->covers(CallbackComparator::class);
