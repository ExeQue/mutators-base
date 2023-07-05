<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate;

use ExeQue\Remix\Mutate\MutatesUsing;

it('call the callback when mutating', function () {
    $mutator = MutatesUsing::make(function ($value) {
        return $value . 'bar';
    });

    expect($mutator->mutate('foo'))->toBe('foobar');
});
