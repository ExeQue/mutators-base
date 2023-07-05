<?php

declare(strict_types=1);

namespace Tests\Unit\Concerns;

use ExeQue\Remix\Compare\Comparator;
use ExeQue\Remix\Concerns\ResolvesComparators;
use ExeQue\Remix\Exceptions\InvalidComparatorException;
use ExeQue\Remix\Mutate\Mutator;

it('resolves comparators', function (mixed $input) {
    $implementation = new class()
    {
        use ResolvesComparators {
            resolveComparator as public;
        }
    };

    $implementation->resolveComparator($input);
})->throwsNoExceptions()->with([
    'boolean' => [
        'input' => true,
    ],
    'callable' => [
        'input' => fn () => true,
    ],
    'instance of ComparatorInterface' => [
        'input' => new class() extends Comparator
        {
            public function check(mixed $value): bool
            {
                return true;
            }
        },
    ],
    'instance of MutatorInterface' => [
        'input' => new class() extends Mutator
        {
            public function mutate(mixed $value): bool
            {
                return true;
            }
        },
    ],
    'array of valid values' => [
        'input' => [
            true,
            fn () => true,
            new class() extends Comparator
            {
                public function check(mixed $value): bool
                {
                    return true;
                }
            },
            new class() extends Mutator
            {
                public function mutate(mixed $value): bool
                {
                    return true;
                }
            },
        ],
    ],
]);

it('fails to resolve if the given comparator is not supported', function () {
    $implementation = new class()
    {
        use ResolvesComparators {
            resolveComparator as public;
        }
    };

    $implementation->resolveComparator('invalid');
})->throws(InvalidComparatorException::class);
