<?php

declare(strict_types=1);

namespace Tests\Unit;

use ExeQue\Mutators\CallbackMutator;

test('call the callback when mutating', function () {
    $mutator = CallbackMutator::make(function ($value) {
        return $value . 'bar';
    });

    expect($mutator->mutate('foo'))->toBe('foobar');
});
