<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\Array;

use ExeQue\Remix\Exceptions\InvalidArgumentException;
use ExeQue\Remix\Mutate\Array\WalkRecursive;

it('walks through an array', function () {
    $mutator = WalkRecursive::make(function (&$value) {
        $value = mb_strtoupper($value);
    });

    expect($mutator->mutate([
        'foo' => 'bar',
        'baz' => [
            'qux' => 'quux',
        ],
    ]))->toBe([
        'foo' => 'BAR',
        'baz' => [
            'qux' => 'QUUX',
        ],
    ]);
});

it('throws an exception if callback parameter #1 is not by reference', function () {
    WalkRecursive::make(function ($value) {
    });
})->throws(InvalidArgumentException::class);

it('throws an exception if callback takes more than 2 parameters', function () {
    WalkRecursive::make(function ($param1, $param2, $param3) {
    });
})->throws(InvalidArgumentException::class);

it('throws an exception if callback takes no parameters', function () {
    WalkRecursive::make(function () {
    });
})->throws(InvalidArgumentException::class);
