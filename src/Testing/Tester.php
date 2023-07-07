<?php

declare(strict_types=1);

namespace ExeQue\Remix\Testing;

use ExeQue\Remix\Compare\ComparatorInterface;
use ExeQue\Remix\Mutate\MutatorInterface;
use ExeQue\Remix\Serialize\SerializerInterface;
use ReflectionClass;
use ReflectionIntersectionType;
use ReflectionMethod;
use ReflectionNamedType;
use ReflectionParameter;
use ReflectionUnionType;
use Spatie\StructureDiscoverer\Discover;

class Tester
{
    public static function runAll(string $directory): void
    {
        self::testDocblock($directory);
        self::testMakeMethod($directory);
        self::testHasNoOtherInstancedPublicMethods($directory);
    }

    public static function locateAll(string $directory): array
    {
        return [
            ...self::locateMutators($directory),
            ...self::locateComparators($directory),
            ...self::locateSerializers($directory),
        ];
    }

    public static function locateMutators(string $directory): array
    {
        $classes = Discover::in($directory)->classes()->getWithoutCache();

        return array_filter($classes, function (string $class) {
            $reflector = new ReflectionClass($class);

            if ($reflector->isAbstract() || $reflector->isInterface()) {
                return false;
            }

            if (! in_array(MutatorInterface::class, $reflector->getInterfaceNames(), true)) {
                return false;
            }

            return true;
        });
    }

    public static function locateComparators(string $directory): array
    {
        $classes = Discover::in($directory)->classes()->getWithoutCache();

        return array_filter($classes, function (string $class) {
            $reflector = new ReflectionClass($class);

            if ($reflector->isAbstract() || $reflector->isInterface()) {
                return false;
            }

            if (! in_array(ComparatorInterface::class, $reflector->getInterfaceNames(), true)) {
                return false;
            }

            return true;
        });
    }

    public static function locateSerializers(string $directory): array
    {
        $classes = Discover::in($directory)->classes()->getWithoutCache();

        return array_filter($classes, function (string $class) {
            $reflector = new ReflectionClass($class);

            if ($reflector->isAbstract() || $reflector->isInterface()) {
                return false;
            }

            if (! in_array(SerializerInterface::class, $reflector->getInterfaceNames(), true)) {
                return false;
            }

            return true;
        });
    }

    public static function testDocblock(string $directory): void
    {
        it('has docblock', function (string $class) {
            $reflector = new ReflectionClass($class);

            $constructor = $reflector->getConstructor();
            $maker       = $reflector->hasMethod('make') ? $reflector->getMethod('make') : null;

            $classDocblock = $reflector->getDocComment();

            expect($classDocblock)->toBeString('Docblock is missing on ' . $class);

            if ($constructor) {
                $constructorDocblock = $constructor->getDocComment();
                expect($constructorDocblock)->toBeString('Docblock is missing on ' . $class . '::__construct()');
            }

            if ($maker) {
                $makerDocblock = $maker->getDocComment();
                expect($makerDocblock)->toBeString('Docblock is missing on ' . $class . '::make()');
            }

            if ($constructor && $maker) {
                expect($constructorDocblock)
                    ->toBe($makerDocblock, 'Docblock on ' . $class . '::__construct() and ' . $class . '::make() do not match');
            }
        })->with(self::locateAll($directory));
    }

    public static function testMakeMethod(string $directory): void
    {
        it('has make method', function (string $class) {
            $reflector = new ReflectionClass($class);

            expect(Tester::locateMakeMethod($reflector))->toBeInstanceOf(ReflectionMethod::class, 'Expected class to have a make method on ' . $class);

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
                    'Expected make method to be identical to constructor on ' . $class
                )
                ->and($make->isStatic())->toBeTrue('Expected make method to be static on ' . $class)
                ->and($make->getReturnType()?->getName())
                ->toBe('self', 'Expected make method to return instance of implementer on ' . $class);
        })->with(self::locateAll($directory));
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

    private static function testHasNoOtherInstancedPublicMethods(string $directory): void
    {
        it('has no additional instanced public methods that does not return self', function (string $class) {
            $reflector = new ReflectionClass($class);

            $methods = $reflector->getMethods(ReflectionMethod::IS_PUBLIC);

            $methods = array_filter($methods, function (ReflectionMethod $method) {
                return ! $method->isStatic();
            });

            if ($reflector->implementsInterface(MutatorInterface::class)) {
                $methods = array_filter($methods, function (ReflectionMethod $method) {
                    return ! in_array($method->getName(), ['__construct', '__invoke', 'mutate'], true);
                });
            }

            if ($reflector->implementsInterface(ComparatorInterface::class)) {
                $methods = array_filter($methods, function (ReflectionMethod $method) {
                    return ! in_array($method->getName(), ['__construct', '__invoke', 'check'], true);
                });
            }

            if ($reflector->implementsInterface(SerializerInterface::class)) {
                $methods = array_filter($methods, function (ReflectionMethod $method) {
                    return ! in_array($method->getName(), ['__construct', 'encode', 'decode'], true);
                });
            }

            $methods = array_filter($methods, function (ReflectionMethod $method) {
                return $method->getReturnType()?->getName() !== 'self';
            });

            $methods = array_map(static fn (ReflectionMethod $method) => $method->getName(), $methods);

            expect($methods)->toBeEmpty('Expected class to have no other instanced public methods without return type `self`: ' . implode(', ', $methods));
        })->with(self::locateAll($directory));
    }
}
