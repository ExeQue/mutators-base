<?php

declare(strict_types=1);

namespace Tests\Unit\Concerns;

use ExeQue\Remix\Compare\ComparesUsing;
use ExeQue\Remix\Concerns\HasMultipleComparators;

it('create using array input using makeFromArray', function () {
    $implementation = new class(true)
    {
        use HasMultipleComparators;

        public function getComparators()
        {
            return $this->comparators;
        }
    };

    $comparators = [
        ComparesUsing::make(fn () => true),
        ComparesUsing::make(fn () => true),
        ComparesUsing::make(fn () => true),
    ];

    $comparator = $implementation::makeFromArray($comparators);

    expect($comparator->getComparators())->toBe($comparators);
});

it('supports adding additional comparators', function () {
    $comparator1 = ComparesUsing::make(fn () => true);
    $comparator2 = ComparesUsing::make(fn () => true);

    $implementation = new class($comparator1)
    {
        use HasMultipleComparators;

        public function getComparators()
        {
            return $this->comparators;
        }
    };

    $implementation->with($comparator2);

    expect($implementation->getComparators())->toBe([$comparator1, $comparator2]);
});
