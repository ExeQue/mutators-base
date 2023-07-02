<?php

declare(strict_types=1);

namespace Tests\Asserts;

use ReflectionClass;
use ReflectionIntersectionType;
use ReflectionNamedType;
use ReflectionParameter;
use ReflectionUnionType;

trait AssertsMakeMethod
{
    public function assertMakeMethodIsIdenticalToConstructor(string $class): void
    {
        $reflector = new ReflectionClass($class);

        $make        = $reflector->getMethod('make');
        $constructor = $reflector->getConstructor();

        $mapper = static function (ReflectionParameter $parameter) {
            $type = $parameter->getType();

            $typeNameResolver = static function (ReflectionNamedType $type) {
                return $type->getName();
            };

            if ($type instanceof ReflectionNamedType) {
                $type = $typeNameResolver($type);
            } elseif ($type instanceof ReflectionUnionType || $type instanceof ReflectionIntersectionType) {
                $type = array_map($typeNameResolver, $type->getTypes());
            } else {
                $type = null;
            }

            return [
                'name'                     => $parameter->getName(),
                'nullable'                 => $parameter->allowsNull(),
                'passedByReference'        => $parameter->isPassedByReference(),
                'type'                     => $type,
                'defaultValue'             => $parameter->isDefaultValueAvailable() ? $parameter->getDefaultValue() : null,
                'defaultValueConstantName' => $parameter->isDefaultValueAvailable() && $parameter->isDefaultValueConstant() ? $parameter->getDefaultValueConstantName() : null,
                'variadic'                 => $parameter->isVariadic(),
                'optional'                 => $parameter->isOptional(),
                'position'                 => $parameter->getPosition(),
                'canBePassedByValue'       => $parameter->canBePassedByValue(),
                'hasType'                  => $parameter->hasType(),
            ];
        };

        $makeParameters        = array_map($mapper, $make->getParameters());
        $constructorParameters = array_map($mapper, $constructor->getParameters());

        expect($makeParameters)
            ->toEqual(
                $constructorParameters,
                'Expected make method to be identical to constructor.'
            )
            ->and($make->isStatic())->toBeTrue('Expected make method to be static.')
            ->and($make->getReturnType()->getName())
            ->toBe('self', 'Expected make method to return instance of implementer.');
    }
}
