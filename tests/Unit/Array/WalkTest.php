<?php

declare(strict_types=1);

namespace Tests\Unit\Array;

use ExeQue\Mutators\Array\Walk;
use ExeQue\Mutators\Exceptions\InvalidArgumentException;

test('walks through an array', function () {
    $mutator = Walk::make(function (&$value) {
        $value = mb_strtoupper($value);
    });

    expect($mutator->mutate(['foo' => 'bar']))->toBe(['foo' => 'BAR']);
});

test('fails if callback parameter #1 is not by reference', function () {
    Walk::make(function ($value) {
    });
})->throws(InvalidArgumentException::class);

test('fails if callback takes more than 2 parameters', function () {
    Walk::make(function ($param1, $param2, $param3) {
    });
})->throws(InvalidArgumentException::class);

test('fails if callback takes no parameters', function () {
    Walk::make(function () {
    });
})->throws(InvalidArgumentException::class);
