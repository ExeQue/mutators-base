<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\Array;

use ExeQue\Remix\Mutate\Array\Map;

it('applies callback to each item in array', function () {
    $mutator = Map::make(static fn ($item) => $item * 2);

    expect($mutator->mutate([1, 2, 3]))->toBe([2, 4, 6]);
});

it('provides value and key to callback', function () {
    $mutator = Map::make(static function ($value, $key) {
        expect($value)->toBe('foo')
            ->and($key)->toBe(0);
    });

    $mutator->mutate(['foo']);
});
