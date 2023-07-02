<?php

declare(strict_types=1);


namespace Tests\Unit;

use ExeQue\Mutators\CallbackMutator;
use ExeQue\Mutators\CompoundMutator;
use ExeQue\Mutators\Exceptions\InvalidMutatorException;

test('executes mutators in order', function() {
    $callableObject = new class {
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
        new CallbackMutator(fn($value) => $value . 'there,'),
        fn($value) => $value . ' Gene',
        $callableObject,
        [
            fn($value) => $value . ' Ken',
            [$callableObject, 'call']
        ]
    ];

    $mutator = CompoundMutator::make($mutators);

    expect($mutator->mutate('Hello '))->toBe('Hello there, General Kenobi');
});

test('fails if given an invalid mutator input', function () {
    $mutator = CompoundMutator::make([
        'foo'
    ]);
})->throws(InvalidMutatorException::class);
