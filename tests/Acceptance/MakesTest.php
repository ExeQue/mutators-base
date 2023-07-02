<?php

declare(strict_types=1);

namespace Tests\Acceptance;

use ExeQue\Mutators\Concerns\Makes;
use ReflectionClass;
use ReflectionMethod;

test('takes no arguments', function () {
    $reflector = new ReflectionClass(Makes::class);

    $method = $reflector->getMethod('make');

    expect($method->getNumberOfParameters())->toBe(0);
});

test('make method exists', function (string $class) {
    $reflector = new ReflectionClass($class);

    expect(locateMakeMethod($reflector))->toBeInstanceOf(ReflectionMethod::class, 'Expected class to have a make method');

    $this->assertMakeMethodIsIdenticalToConstructor($class);
})->with(locateMutatorClasses());

function locateMakeMethod(ReflectionClass $reflector): ?ReflectionMethod
{
    $method = null;

    while ($method === null) {
        if ($reflector->hasMethod('make')) {
            $method = $reflector->getMethod('make');
        } else {
            $reflector = $reflector->getParentClass();
        }

        if ($reflector === false) {
            break;
        }
    }

    return $method;
}
