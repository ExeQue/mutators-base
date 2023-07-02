<?php

declare(strict_types=1);

namespace Tests\Acceptance;

test('mutator has docblock', function (string $class) {
    $reflection = new \ReflectionClass($class);

    $docblock = $reflection->getDocComment();

    expect($docblock)->toBeString('Docblock is missing');
})->with(locateMutatorClasses());
