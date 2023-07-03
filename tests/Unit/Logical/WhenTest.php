<?php

declare(strict_types=1);

namespace Tests\Unit\Logical;

use ExeQue\Mutators\Logical\When;

test('executes then if condition is met', function () {
    $mutator = When::make(true, fn () => 'foo', fn () => 'bar');

    expect($mutator->mutate(''))->toBe('foo');
});

test('executes otherwise if condition is not met', function () {
    $mutator = When::make(false, fn () => 'foo', fn () => 'bar');

    expect($mutator->mutate(''))->toBe('bar');
});

test('does not execute then if condition is not met', function () {
    $mutator = When::make(false, fn () => 'foo', fn () => 'bar');

    expect($mutator->mutate(''))->not->toBe('foo');
});

test('does not do anything if condition is not met and otherwise is not provided', function () {
    $mutator = When::make(false, fn () => 'foo');

    expect($mutator->mutate(''))->toBe('');
});
