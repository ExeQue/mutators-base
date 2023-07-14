<?php

declare(strict_types=1);

namespace Tests\Unit\Concerns;

use ExeQue\Remix\Compare\Comparator;
use ExeQue\Remix\Concerns\ResolvesMutators;
use ExeQue\Remix\Exceptions\InvalidArgumentException;
use ExeQue\Remix\Mutate\Mutator;

it('resolves mutators', function (mixed $input) {
    $implementation = new class () {
        use ResolvesMutators {
            resolveMutator as public;
        }
    };

    $implementation->resolveMutator($input);
})->throwsNoExceptions()->with([
    'callable' => [
        'input' => fn () => fn () => 'foobar',
    ],
    'instance of ComparatorInterface' => [
        'input' => new class () extends Comparator {
            public function check(mixed $value): bool
            {
                return true;
            }
        },
    ],
    'instance of MutatorInterface' => [
        'input' => new class () extends Mutator {
            public function mutate(mixed $value): string
            {
                return 'foobar';
            }
        },
    ],
    'array of valid values' => [
        'input' => [
            fn () => true,
            new class () extends Comparator {
                public function check(mixed $value): bool
                {
                    return true;
                }
            },
            new class () extends Mutator {
                public function mutate(mixed $value): string
                {
                    return 'foobar';
                }
            },
        ],
    ],
]);

it('throws an exception when the given comparator is not supported', function () {
    $implementation = new class () {
        use ResolvesMutators {
            resolveMutator as public;
        }
    };

    $implementation->resolveMutator('invalid');
})->throws(InvalidArgumentException::class);
