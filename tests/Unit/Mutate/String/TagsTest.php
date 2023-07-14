<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\String;

use ExeQue\Remix\Exceptions\InvalidArgumentException;
use ExeQue\Remix\Exceptions\MissingTagException;
use ExeQue\Remix\Mutate\String\Tags;

it('replaces tags in string', function (mixed $tags, mixed $options, mixed $input, mixed $expected) {
    $mutator = Tags::make($tags, $options);

    expect($mutator->mutate($input))->toBe($expected);
})->with([
    'without whitespace around tags' => [
        'tags' => [
            'name' => 'John Doe',
        ],
        'options'  => [],
        'input'    => 'Hello, {{name}}!',
        'expected' => 'Hello, John Doe!',
    ],
    'with whitespace around tags' => [
        'tags' => [
            'name' => 'John Doe',
        ],
        'options'  => [],
        'input'    => 'Hello, {{ name }}!',
        'expected' => 'Hello, John Doe!',
    ],
    'with multiple tags' => [
        'tags' => [
            'name' => 'John Doe',
            'age'  => 30,
        ],
        'options'  => [],
        'input'    => 'Hello, {{ name }}! You are {{ age }} years old.',
        'expected' => 'Hello, John Doe! You are 30 years old.',
    ],
    'ignores missing tag' => [
        'tags' => [
            'name' => 'John Doe',
        ],
        'options'  => [],
        'input'    => 'Hello, {{ name }}! You are {{ age }} years old.',
        'expected' => 'Hello, John Doe! You are {{ age }} years old.',
    ],
    'removes missing tag' => [
        'tags' => [
            'name' => 'John Doe',
        ],
        'options' => [
            'removeWhenMissing' => true,
        ],
        'input'    => 'Hello, {{ name }}! You are {{ age }} years old.',
        'expected' => 'Hello, John Doe! You are  years old.',
    ],
    'ignores tag casing' => [
        'tags' => [
            'NAME' => 'John Doe',
        ],
        'options' => [
            'forceLowerCaseKeys' => true,
        ],
        'input'    => 'Hello, {{ name }}!',
        'expected' => 'Hello, John Doe!',
    ],
    'ignores key casing with multibyte characters' => [
        'tags' => [
            'æ' => 'John Doe',
        ],
        'options' => [
            'forceLowerCaseKeys' => true,
        ],
        'input'    => 'Hello, {{ Æ }}!',
        'expected' => 'Hello, John Doe!',
    ],
    'removes missing tag while ignoring casing' => [
        'tags' => [
            'name' => 'John Doe',
        ],
        'options' => [
            'removeWhenMissing'  => true,
            'forceLowerCaseKeys' => true,
        ],
        'input'    => 'Hello, {{ NAME }}! You are {{ AGE }} years old.',
        'expected' => 'Hello, John Doe! You are  years old.',
    ],
]);

it('throws an exception if a tag is found but not available in the input tags when `throwWhenMissing` is enabled', function () {
    $mutator = Tags::make(['name' => 'John Doe'], ['throwWhenMissing' => true]);

    $mutator->mutate('Hello, {{ name }}! You are {{ age }} years old.');
})->throws(MissingTagException::class);

it('throws an exception when given a non-stringable input', function () {
    $mutator = Tags::make([]);

    $mutator->mutate([]);
})->throws(InvalidArgumentException::class);
