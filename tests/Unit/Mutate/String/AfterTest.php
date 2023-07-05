<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\String;

use ExeQue\Remix\Mutate\String\After;

it('retrieves after first', function () {
    $input   = 'Hello there, General Kenobi. Hello there, Mr. Anderson';
    $mutator = After::make('there', false);

    expect($mutator->mutate($input))->toBe(', General Kenobi. Hello there, Mr. Anderson');
});

it('retrieves after last', function () {
    $input   = 'Hello there, General Kenobi. Hello there, Mr. Anderson';
    $mutator = After::make('there', true);

    expect($mutator->mutate($input))->toBe(', Mr. Anderson');
});

it('outputs input string of search is not found', function () {
    $input   = 'Hello there, General Kenobi. Hello there, Mr. Anderson';
    $mutator = After::make('not found');

    expect($mutator->mutate($input))->toBe($input);
});
