<?php

declare(strict_types=1);

namespace Tests\Unit\Compare;

use ExeQue\Remix\Compare\CallbackComparator;

test('call the callback when mutating', function () {
    $mutator = CallbackComparator::make(function ($value) {
        return $value . 'bar';
    });

    expect($mutator->check('foo'))->toBe(true);
});
