<?php

declare(strict_types=1);

namespace ExeQue\Mutators\Testing;

use ExeQue\Mutators\Alias;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\Attributes\CodeCoverageIgnore;
use PHPUnit\Framework\Attributes\IgnoreClassForCodeCoverage;
use ReflectionClass;

#[CodeCoverageIgnore]
#[IgnoreClassForCodeCoverage(AliasTester::class)]
class AliasTester
{
    public static function assertAliasContainsInstanceOf(Alias $alias, string $class, string $message = ''): void
    {
        $reflector = new ReflectionClass($alias);
        $property  = $reflector->getParentClass()->getProperty('mutator');

        Assert::assertInstanceOf($class, $property->getValue($alias), $message ?: "Alias does not contain instance of {$class}");
    }

    public static function assertOnAliasContainingClass(Alias $alias, callable $callback): void
    {
        $callback = $callback(...);

        $reflector = new ReflectionClass($alias);
        $property  = $reflector->getParentClass()->getProperty('mutator');

        $callback($property->getValue($alias));
    }
}
