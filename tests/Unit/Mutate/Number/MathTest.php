<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\Number;

use ExeQue\Remix\Exceptions\InvalidArgumentException;
use ExeQue\Remix\Mutate\Number\Math\Add;
use ExeQue\Remix\Mutate\Number\Math\Divide;
use ExeQue\Remix\Mutate\Number\Math\Modulo;
use ExeQue\Remix\Mutate\Number\Math\Multiply;
use ExeQue\Remix\Mutate\Number\Math\Pow;
use ExeQue\Remix\Mutate\Number\Math\Root;
use ExeQue\Remix\Mutate\Number\Math\Subtract;

it('adds two numbers', function () {
    $add = Add::make(2);

    expect($add->mutate(2))->toBe(4);
});

it('subtracts two numbers', function () {
    $subtract = Subtract::make(2);

    expect($subtract->mutate(4))->toBe(2);
});

it('divides two numbers', function () {
    $divide = Divide::make(2);

    expect($divide->mutate(4))->toBe(2);
});

it('cannot divide by zero', function () {
    $divide = Divide::make(0);

    expect($divide->mutate(4))->toBe(0);
})->throws(InvalidArgumentException::class);

it('multiplies two numbers', function () {
    $multiply = Multiply::make(2);

    expect($multiply->mutate(4))->toBe(8);
});

it('gets the remainder of two numbers', function () {
    $modulo = Modulo::make(2);

    expect($modulo->mutate(4))->toBe(0);
});

it('raises a number to a power', function () {
    $pow = Pow::make(2);

    expect($pow->mutate(4))->toEqual(16);
});

it('uses square alias on pow', function () {
    $pow = Pow::square();

    expect($pow->mutate(4))->toEqual(16);
});

it('uses cube alias on pow', function () {
    $pow = Pow::cube();

    expect($pow->mutate(4))->toEqual(64);
});

it('uses square alias on root', function () {
    $squareRoot = Root::square();

    expect($squareRoot->mutate(4))->toEqual(2);
});

it('uses cube alias on root', function () {
    $squareRoot = Root::cube();

    expect($squareRoot->mutate(8))->toEqual(2);
});
