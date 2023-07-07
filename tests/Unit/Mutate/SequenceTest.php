<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate;

use ExeQue\Remix\Exceptions\InvalidMutatorException;
use ExeQue\Remix\Mutate\MutatesUsing;
use ExeQue\Remix\Mutate\Sequence;
use ExeQue\Remix\Mutate\When;
use ReflectionClass;

it('executes mutators in order', function () {
    $callableObject = new class
    {
        public function __invoke($value): string
        {
            return $value . 'ral';
        }

        public function call($value): string
        {
            return $value . 'obi';
        }
    };

    $mutators = [
        new MutatesUsing(fn ($value) => $value . 'there,'),
        fn ($value) => $value . ' Gene',
        $callableObject,
        [
            fn ($value) => $value . ' Ken',
            [$callableObject, 'call'],
        ],
    ];

    $mutator = Sequence::make($mutators);

    expect($mutator->mutate('Hello '))->toBe('Hello there, General Kenobi');
});

it('fails if given an invalid mutator input', function () {
    $mutator = Sequence::make([
        'foo',
    ]);
})->throws(InvalidMutatorException::class);

it('allows empty mutators', function () {
    $mutator = Sequence::make();
})->throwsNoExceptions();

it('supports adding additional mutators', function () {
    $mutator = new MutatesUsing(fn ($value) => $value . 'foo');

    $implementation = Sequence::make();

    $implementation->then($mutator);

    $reflector = new ReflectionClass($implementation);
    $property  = $reflector->getProperty('mutators');

    expect($property->getValue($implementation))->toEqual([$mutator]);
});

it('supports adding additional mutators with a callable', function () {
    $mutator = new MutatesUsing(fn ($value) => $value . 'foo');

    $implementation = Sequence::make();

    $implementation->then(fn () => $mutator);

    $reflector = new ReflectionClass($implementation);
    $property  = $reflector->getProperty('mutators');

    expect($property->getValue($implementation))->toEqual([$mutator]);
});

it('supports adding conditional mutators', function () {
    $mutator = new MutatesUsing(fn ($value) => $value . 'foo');

    $implementation = Sequence::make();

    $implementation->when(fn () => true, $mutator);

    $reflector = new ReflectionClass($implementation);
    $property  = $reflector->getProperty('mutators');

    expect($property->getValue($implementation))->toEqual([
        When::make(
            static fn () => true,
            $mutator
        ),
    ]);
});

it('directly adds the then mutator if the condition is boolean true', function () {
    $thenMutator = new MutatesUsing(fn ($value) => $value . 'foo');

    $implementation = Sequence::make();

    $implementation->when(true, $thenMutator);

    $reflector = new ReflectionClass($implementation);
    $property  = $reflector->getProperty('mutators');

    expect($property->getValue($implementation))->toEqual([$thenMutator]);
});

it('directly adds the otherwise mutator if the condition is boolean false', function () {
    $thenMutator      = new MutatesUsing(fn ($value) => $value . 'foo');
    $otherwiseMutator = new MutatesUsing(fn ($value) => $value . 'bar');

    $implementation = Sequence::make();

    $implementation->when(false, $thenMutator, $otherwiseMutator);

    $reflector = new ReflectionClass($implementation);
    $property  = $reflector->getProperty('mutators');

    expect($property->getValue($implementation))->toEqual([$otherwiseMutator]);
});
