<?php

declare(strict_types=1);

namespace Tests\Unit\Compare\Countable;

use Countable;
use ExeQue\Remix\Compare\Countable\CountableComparator;
use Mockery;

test('passes with countable types', function (mixed $input) {
    $comparator = new class extends CountableComparator
    {
        protected function checkCount(int $count): bool
        {
            return true;
        }
    };

    $comparator->check($input);
})->throwsNoExceptions()->with([
    'array' => [
        'input' => [1, 2, 3],
    ],
    'countable' => [
        'input' => new class implements Countable
        {
            public function count(): int
            {
                return 3;
            }
        },
    ],
    'object with count method' => [
        'input' => new class
        {
            public function count(): int
            {
                return 3;
            }
        },
    ],
]);

test('fails if given a non-countable input', function () {
    $comparator = Mockery::mock(CountableComparator::class);

    $comparator->check('foo');
})->throws(\InvalidArgumentException::class);
