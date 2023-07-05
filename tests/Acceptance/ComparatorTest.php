<?php

declare(strict_types=1);

namespace Tests\Acceptance;

use ExeQue\Remix\Compare\Comparator;
use ReflectionClass;

it('method __invoke must be final', function () {
    $reflector = new ReflectionClass(Comparator::class);

    expect($reflector->getMethod('__invoke')->isFinal())->toBeTrue();
});
