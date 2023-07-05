<?php

declare(strict_types=1);

namespace Tests\Unit;

use ExeQue\Remix\Mutate\When;

it('executes then if condition is met', function () {
    $mutator = When::make(true, fn () => 'foo', fn () => 'bar');

    expect($mutator->mutate(''))->toBe('foo');
});

it('executes otherwise if condition is not met', function () {
    $mutator = When::make(false, fn () => 'foo', fn () => 'bar');

    expect($mutator->mutate(''))->toBe('bar');
});

it('does not execute then if condition is not met', function () {
    $mutator = When::make(false, fn () => 'foo', fn () => 'bar');

    expect($mutator->mutate(''))->not->toBe('foo');
});

it('does not do anything if condition is not met and otherwise is not provided', function () {
    $mutator = When::make(false, fn () => 'foo');

    expect($mutator->mutate(''))->toBe('');
});
