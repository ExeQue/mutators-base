<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate;

use ExeQue\Remix\Mutate\CallbackMutator;

test('call the callback when mutating', function () {
    $mutator = CallbackMutator::make(function ($value) {
        return $value . 'bar';
    });

    expect($mutator->mutate('foo'))->toBe('foobar');
});
