<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate;

use ExeQue\Remix\Exceptions\InvalidArgumentException;
use ExeQue\Remix\Mutate\MutatesUsing;
use ExeQue\Remix\Mutate\Sequence;
use ExeQue\Remix\Mutate\When;

it('executes sequence in order', function (mixed $mutators, mixed $input, mixed $expected) {
    $mutator = Sequence::make($mutators);

    expect($mutator->mutate($input))->toBe($expected);
})->with([
    'empty sequence' => [
        'mutators' => [],
        'input'    => 'foo',
        'expected' => 'foo',
    ],
    'single mutator' => [
        'mutators' => [
            fn ($value) => $value . 'bar',
        ],
        'input'    => 'foo',
        'expected' => 'foobar',
    ],
    'multiple mutators' => [
        'mutators' => [
            fn ($value) => $value . 'bar',
            fn ($value) => $value . 'baz',
        ],
        'input'    => 'foo',
        'expected' => 'foobarbaz',
    ],
]);

it('throws an exception when given an invalid sequence', function () {
    Sequence::make(['foo',]);
})->throws(InvalidArgumentException::class);

it('supports adding additional actions', function () {
    $mutator = new MutatesUsing(fn ($value) => $value . 'foo');

    $sequence = Sequence::make();

    $sequence->then($mutator);

    expect(Sequence::make([$mutator]))->toEqual($sequence);
});

it('supports adding conditional actions', function () {
    $thenMutator      = new MutatesUsing(fn ($value) => $value . 'foo');
    $otherwiseMutator = new MutatesUsing(fn ($value) => $value . 'bar');

    $sequence = Sequence::make();

    $sequence->when(fn () => true, $thenMutator, $otherwiseMutator);

    expect(Sequence::make([When::make(fn () => true, $thenMutator, $otherwiseMutator)]))->toEqual($sequence);
});

it('directly adds the then mutator if the condition is boolean true', function () {
    $thenMutator = new MutatesUsing(fn ($value) => $value . 'foo');

    $sequence = Sequence::make();

    $sequence->when(true, $thenMutator);

    expect(Sequence::make([$thenMutator]))->toEqual($sequence);
});

it('directly adds the otherwise mutator if the condition is boolean false', function () {
    $thenMutator      = new MutatesUsing(fn ($value) => $value . 'foo');
    $otherwiseMutator = new MutatesUsing(fn ($value) => $value . 'bar');

    $sequence = Sequence::make();

    $sequence->when(false, $thenMutator, $otherwiseMutator);

    expect(Sequence::make([$otherwiseMutator]))->toEqual($sequence);
});
