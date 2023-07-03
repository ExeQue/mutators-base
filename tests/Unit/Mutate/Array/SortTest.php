<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\Array;

use ExeQue\Remix\Data\SortDirection;
use ExeQue\Remix\Mutate\Array\Sort;

test('sorts array ascending and retains key association', function () {
    $mutator = Sort::asc();

    expect($mutator->mutate([3, 2, 1]))->toBe([2 => 1, 1 => 2, 0 => 3]);
});

test('sorts array descending and retains key association', function () {
    $mutator = Sort::desc();

    expect($mutator->mutate([1, 2, 3]))->toBe([2 => 3, 1 => 2, 0 => 1]);
});

test('sorts array ascending and resets key association', function () {
    $mutator = Sort::asc(preserveKeys: false);

    expect($mutator->mutate([3, 2, 1]))->toBe([0 => 1, 1 => 2, 2 => 3]);
});

test('sorts array descending and resets key association', function () {
    $mutator = Sort::desc(preserveKeys: false);

    expect($mutator->mutate([1, 2, 3]))->toBe([0 => 3, 1 => 2, 2 => 1]);
});

test('sorts array ascending using callback', function () {
    $mutator = Sort::make(SortDirection::Asc, callback: static fn ($value) => $value['name'], preserveKeys: false);

    $input = [
        ['name' => 'Billy'],
        ['name' => 'Michael'],
        ['name' => 'Adam'],
    ];

    $expected = [
        ['name' => 'Adam'],
        ['name' => 'Billy'],
        ['name' => 'Michael'],
    ];

    expect($mutator->mutate($input))->toBe($expected);
});

test('sorts array descending using callback', function () {
    $mutator = Sort::make(SortDirection::Desc, callback: static fn ($value) => $value['name'], preserveKeys: false);

    $input = [
        ['name' => 'Billy'],
        ['name' => 'Michael'],
        ['name' => 'Adam'],
    ];

    $expected = [
        ['name' => 'Michael'],
        ['name' => 'Billy'],
        ['name' => 'Adam'],
    ];

    expect($mutator->mutate($input))->toBe($expected);
});
