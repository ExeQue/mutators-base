<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\Array;

use ExeQue\Remix\Exceptions\InvalidArgumentException;
use ExeQue\Remix\Mutate\Array\Walk;

it('walks through an array', function () {
    $mutator = Walk::make(function (&$value) {
        $value = mb_strtoupper($value);
    });

    expect($mutator->mutate(['foo' => 'bar']))->toBe(['foo' => 'BAR']);
});

it('throws an exception if callback parameter #1 is not by reference', function () {
    Walk::make(function ($value) {
    });
})->throws(InvalidArgumentException::class);

it('throws an exception if callback takes more than 2 parameters', function () {
    Walk::make(function ($param1, $param2, $param3) {
    });
})->throws(InvalidArgumentException::class);

it('throws an exception if callback takes no parameters', function () {
    Walk::make(function () {
    });
})->throws(InvalidArgumentException::class);
