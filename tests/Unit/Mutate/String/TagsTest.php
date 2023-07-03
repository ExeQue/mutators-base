<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\String;

use ExeQue\Remix\Exceptions\MissingTagException;
use ExeQue\Remix\Mutate\String\Tags;

test('replaces tags in string', function (string $input, array $tags, string $expected) {
    $mutator = Tags::make($tags);

    expect($mutator->mutate($input))->toBe($expected);
})->with([
    'without whitespace around tags' => [
        'input' => 'Hello, {{name}}!',
        'tags'  => [
            'name' => 'John Doe',
        ],
        'expected' => 'Hello, John Doe!',
    ],
    'with whitespace around tags' => [
        'input' => 'Hello, {{ name }}!',
        'tags'  => [
            'name' => 'John Doe',
        ],
        'expected' => 'Hello, John Doe!',
    ],
    'with multiple tags' => [
        'input' => 'Hello, {{ name }}! You are {{ age }} years old.',
        'tags'  => [
            'name' => 'John Doe',
            'age'  => 30,
        ],
        'expected' => 'Hello, John Doe! You are 30 years old.',
    ],
    'with multiple tags and whitespace' => [
        'input' => 'Hello, {{ name }}! You are {{ age }} years old.',
        'tags'  => [
            'name' => 'John Doe',
            'age'  => 30,
        ],
        'expected' => 'Hello, John Doe! You are 30 years old.',
    ],
    'with missing tag' => [
        'input' => 'Hello, {{ name }}! You are {{ age }} years old.',
        'tags'  => [
            'name' => 'John Doe',
        ],
        'expected' => 'Hello, John Doe! You are {{ age }} years old.',
    ],
]);

test('ignores tag casing if prompted', function () {
    $mutator = new Tags(['NAME' => 'John Doe'], ['forceLowerCaseKeys' => true]);

    expect($mutator->mutate('Hello, {{ name }}!'))->toBe('Hello, John Doe!');
});

test('removes tag when missing if prompted', function () {
    $mutator = new Tags(['name' => 'John Doe'], ['removeOnMissing' => true]);

    expect($mutator->mutate('Hello, {{ name }}! You are {{ age }} years old.'))->toBe('Hello, John Doe! You are  years old.');
});

test('fails if a tag is missing if prompted', function () {
    $mutator = new Tags(['name' => 'John Doe'], ['throwWhenMissing' => true]);

    $mutator->mutate('Hello, {{ name }}! You are {{ age }} years old.');
})->throws(MissingTagException::class);
