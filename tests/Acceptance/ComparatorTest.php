<?php

declare(strict_types=1);

namespace Tests\Acceptance;

use ExeQue\Mutators\Comparator;
use ReflectionClass;

test('method __invoke must be final', function () {
    $reflector = new ReflectionClass(Comparator::class);

    expect($reflector->getMethod('__invoke')->isFinal())->toBeTrue()
        ->and($reflector->getMethod('mutate')->isFinal())->toBeTrue();
});
