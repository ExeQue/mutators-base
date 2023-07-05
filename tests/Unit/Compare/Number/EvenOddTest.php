<?php

declare(strict_types=1);

namespace Tests\Unit\Compare\Number;

use ExeQue\Remix\Compare\Number\IsEven;
use ExeQue\Remix\Compare\Number\IsOdd;

it('number is even', function () {
    expect(IsEven::make()->check(2))->toBeTrue()
        ->and(IsOdd::make()->check(2))->toBeFalse();
});

it('number is odd', function () {
    expect(IsEven::make()->check(3))->toBeFalse()
        ->and(IsOdd::make()->check(3))->toBeTrue();
});

it('evaluates only the ', function () {
    expect(IsEven::make()->check(3.2))->toBeFalse()
        ->and(IsOdd::make()->check(3.2))->toBeTrue()
        ->and(IsEven::make()->check(2.2))->toBeTrue()
        ->and(IsOdd::make()->check(2.2))->toBeFalse();
});
