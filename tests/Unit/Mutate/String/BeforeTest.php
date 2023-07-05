<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\String;

use ExeQue\Remix\Mutate\String\Before;

it('retrieves before first', function () {
    $input   = 'Hello there, General Kenobi. Hello there, Mr. Anderson';
    $mutator = Before::make('there', false);

    expect($mutator->mutate($input))->toBe('Hello ');
});

it('retrieves before last', function () {
    $input   = 'Hello there, General Kenobi. Hello there, Mr. Anderson';
    $mutator = Before::make('there', true);

    expect($mutator->mutate($input))->toBe('Hello there, General Kenobi. Hello ');
});

it('outputs input string of search is not found', function () {
    $input   = 'Hello there, General Kenobi. Hello there, Mr. Anderson';
    $mutator = Before::make('not found');

    expect($mutator->mutate($input))->toBe($input);
});
