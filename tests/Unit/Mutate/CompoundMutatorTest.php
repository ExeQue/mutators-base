<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate;

use ExeQue\Remix\Exceptions\InvalidMutatorException;
use ExeQue\Remix\Mutate\CompoundMutator;
use ExeQue\Remix\Mutate\MutatesUsing;
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

    $mutator = CompoundMutator::make($mutators);

    expect($mutator->mutate('Hello '))->toBe('Hello there, General Kenobi');
});

it('fails if given an invalid mutator input', function () {
    $mutator = CompoundMutator::make([
        'foo',
    ]);
})->throws(InvalidMutatorException::class);

it('allows empty mutators', function () {
    $mutator = CompoundMutator::make();
})->throwsNoExceptions();

it('supports adding additional mutators', function () {
    $mutator = new MutatesUsing(fn ($value) => $value . 'foo');

    $implementation = CompoundMutator::make();

    $implementation->with($mutator);

    $reflector = new ReflectionClass($implementation);
    $property  = $reflector->getProperty('mutators');

    expect($property->getValue($implementation))->toBe([$mutator]);
});
