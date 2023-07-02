<?php

declare(strict_types=1);

namespace Tests\Asserts;

use ExeQue\Mutators\Alias;
use PHPUnit\Framework\Assert;
use ReflectionClass;

trait AssertsOnAliases
{
    public function assertAliasContainsInstanceOf(Alias $alias, string $class, string $message = ''): void
    {
        $reflector = new ReflectionClass($alias);
        $property  = $reflector->getParentClass()->getProperty('mutator');

        Assert::assertInstanceOf($class, $property->getValue($alias), $message);
    }

    public function assertOnAliasContainingClass(Alias $alias, callable $callback)
    {
        $callback = $callback(...);
        $callback->bindTo($this);

        $reflector = new ReflectionClass($alias);
        $property  = $reflector->getParentClass()->getProperty('mutator');

        $callback($property->getValue($alias));
    }
}
