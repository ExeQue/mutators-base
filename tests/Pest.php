<?php

declare(strict_types=1);

use ExeQue\Mutators\MutatorInterface;
use Spatie\StructureDiscoverer\Discover;
use Tests\TestCase;

uses(TestCase::class)->in('Unit');

uses(TestCase::class)->in('Acceptance');

function locateMutatorClasses(callable $filter = null): array
{
    if ($filter === null) {
        $filter = static fn () => true;
    }

    $classes = Discover::in(__DIR__ . '/../src/')->classes()->getWithoutCache();

    return array_filter($classes, function (string $class) use ($filter) {
        $reflector = new \ReflectionClass($class);

        if ($reflector->isAbstract() || $reflector->isInterface()) {
            return false;
        }

        if (! in_array(MutatorInterface::class, $reflector->getInterfaceNames(), true)) {
            return false;
        }

        if (! $filter($reflector, $class)) {
            return false;
        }

        return true;
    });
}
