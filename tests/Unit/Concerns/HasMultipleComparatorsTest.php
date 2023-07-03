<?php

declare(strict_types=1);

namespace Tests\Unit\Concerns;

use ExeQue\Mutators\CallbackComparator;
use ExeQue\Mutators\Concerns\HasMultipleComparators;

test('create using array input using makeFromArray', function () {
    $implementation = new class(true)
    {
        use HasMultipleComparators;

        public function getComparators()
        {
            return $this->comparators;
        }
    };

    $comparators = [
        new CallbackComparator(fn () => true),
        new CallbackComparator(fn () => true),
        new CallbackComparator(fn () => true),
    ];

    $comparator = $implementation::makeFromArray($comparators);

    expect($comparator->getComparators())->toBe($comparators);
});
