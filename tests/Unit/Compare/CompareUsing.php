<?php

declare(strict_types=1);

namespace Tests\Unit\Compare;

use ExeQue\Remix\Compare\ComparesUsing;

it('call the callback when mutating', function () {
    $mutator = ComparesUsing::make(function ($value) {
        return $value . 'bar';
    });

    expect($mutator->check('foo'))->toBe(true);
});
