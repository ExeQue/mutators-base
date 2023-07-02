<?php

declare(strict_types=1);

namespace Tests\Acceptance;

use ExeQue\Mutators\String\StringMutator;
use ReflectionClass;

test('subject mutator mutate method is final', function (string $class) {
    $reflector = new ReflectionClass($class);

    expect($reflector->getMethod('mutate')->isFinal())->toBeTrue();
})->with('subject mutators');

test('subject mutator is abstract', function (string $class) {
    $reflector = new ReflectionClass($class);

    expect($reflector->isAbstract())->toBeTrue();
})->with('subject mutators');

dataset('subject mutators', [

]);
