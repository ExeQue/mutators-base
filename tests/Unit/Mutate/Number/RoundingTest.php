<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\Number;

use ExeQue\Remix\Mutate\Number\Ceil;
use ExeQue\Remix\Mutate\Number\Floor;
use ExeQue\Remix\Mutate\Number\Round;

it('rounds a number to the nearest integer', function (int|float $input, int|float $expected) {
    $mutator = Round::make();

    expect($mutator->mutate($input))->toEqual($expected);
})->with([
    [1.0, 1],
    [1.1, 1],
    [1.5, 2],
    [1.9, 2],
]);

it('rounds a number to the nearest integer with precision', function (int|float $input, int|float $expected) {
    $mutator = Round::make(precision: 1);

    expect($mutator->mutate($input))->toEqual($expected);
})->with([
    [1.00, 1.0],
    [1.01, 1.0],
    [1.05, 1.1],
    [1.09, 1.1],
]);

it('rounds a number to the nearest integer with mode', function (int|float $input, int|float $expected) {
    $mutator = Round::make(mode: PHP_ROUND_HALF_DOWN);

    expect($mutator->mutate($input))->toEqual($expected);
})->with([
    [1.0, 1],
    [1.1, 1],
    [1.5, 1],
    [1.9, 2],
]);

it('rounds a number to the nearest integer with precision and mode', function (int|float $input, int|float $expected) {
    $mutator = Round::make(precision: 1, mode: PHP_ROUND_HALF_DOWN);

    expect($mutator->mutate($input))->toEqual($expected);
})->with([
    [1.00, 1.0],
    [1.01, 1.0],
    [1.05, 1.0],
    [1.09, 1.1],
]);

it('floors a number', function () {
    $mutator = Floor::make();

    expect($mutator->mutate(1.5))->toEqual(1);
});

it('floors a number with precision', function () {
    $mutator = Floor::make(precision: 1);

    expect($mutator->mutate(1.05))->toEqual(1.0);
});

it('ceils a number', function () {
    $mutator = Ceil::make();

    expect($mutator->mutate(1.5))->toEqual(2);
});

it('ceils a number with precision', function () {
    $mutator = Ceil::make(precision: 1);

    expect($mutator->mutate(1.05))->toEqual(1.1);
});
