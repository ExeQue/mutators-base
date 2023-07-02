<?php

declare(strict_types=1);

namespace ExeQue\Mutators\Testing;

use ExeQue\Mutators\MutatorInterface;
use PHPUnit\Framework\Attributes\CodeCoverageIgnore;
use PHPUnit\Framework\Attributes\IgnoreClassForCodeCoverage;
use ReflectionClass;
use ReflectionIntersectionType;
use ReflectionMethod;
use ReflectionNamedType;
use ReflectionParameter;
use ReflectionUnionType;
use Spatie\StructureDiscoverer\Discover;

#[CodeCoverageIgnore]
#[IgnoreClassForCodeCoverage(Tester::class)]
class Tester
{
    public static function runAll(string $directory)
    {
        self::testDocblock($directory);
        self::testMakeMethod($directory);
        self::testHasNoOtherInstancedPublicMethods($directory);
    }

    public static function locateMutators(string $directory, callable $filter = null): array
    {
        if ($filter === null) {
            $filter = static fn () => true;
        }

        $classes = Discover::in($directory)->classes()->getWithoutCache();

        return array_filter($classes, function (string $class) use ($filter) {
            $reflector = new ReflectionClass($class);

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

    public static function testDocblock(string $directory): void
    {
        test('mutator has docblock', function (string $class) {
            $reflection = new ReflectionClass($class);

            $docblock = $reflection->getDocComment();

            expect($docblock)->toBeString('Docblock is missing');
        })->with(self::locateMutators($directory));
    }

    public static function testMakeMethod(string $directory): void
    {
        test('make method exists', function (string $class) {
            $reflector = new ReflectionClass($class);

            expect(Tester::locateMakeMethod($reflector))->toBeInstanceOf(ReflectionMethod::class, 'Expected class to have a make method');

            $make        = $reflector->getMethod('make');
            $constructor = $reflector->getConstructor();
            if ($constructor === null) {
                return;
            }

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
                ->and($make->getReturnType()?->getName())
                ->toBe('self', 'Expected make method to return instance of implementer.');
        })->with(self::locateMutators($directory));
    }

    public static function locateMakeMethod(ReflectionClass $reflector): ?ReflectionMethod
    {
        $method = null;

        while ($method === null) {
            if ($reflector->hasMethod('make')) {
                $method = $reflector->getMethod('make');
            } else {
                /** @noinspection CallableParameterUseCaseInTypeContextInspection */
                $reflector = $reflector->getParentClass();
            }

            if ($reflector === false) {
                break;
            }
        }

        return $method;
    }

    private static function testHasNoOtherInstancedPublicMethods(string $directory)
    {
        test('has no other instanced public methods', function (string $class) {
            $reflector = new ReflectionClass($class);

            $methods = $reflector->getMethods(ReflectionMethod::IS_PUBLIC);

            $methods = array_filter($methods, function (ReflectionMethod $method) {
                return ! $method->isStatic();
            });

            $methods = array_filter($methods, function (ReflectionMethod $method) {
                return ! in_array($method->getName(), ['__construct', '__invoke', 'mutate'], true);
            });

            $methods = array_map(static fn (ReflectionMethod $method) => $method->getName(), $methods);

            expect($methods)->toBeEmpty('Expected class to have no other instanced public methods: ' . implode(', ', $methods));
        })->with(self::locateMutators($directory));
    }
}
