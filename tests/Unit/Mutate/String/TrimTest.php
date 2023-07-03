<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\String;

use ExeQue\Remix\Data\StringDirection;
use ExeQue\Remix\Mutate\String\Trim;

test('trims left', function () {
    $mutator = Trim::make(StringDirection::Left);

    expect($mutator->mutate(' foo '))->toBe('foo ');
});

test('trims right', function () {
    $mutator = Trim::make(StringDirection::Right);

    expect($mutator->mutate(' foo '))->toBe(' foo');
});

test('trims both', function () {
    $mutator = Trim::make(StringDirection::Both);

    expect($mutator->mutate(' foo '))->toBe('foo');
});

test('trims both by default', function () {
    $mutator = Trim::make();

    expect($mutator->mutate(' foo '))->toBe('foo');
});

test('make is identical to constructor', function () {
    $input              = 'Hello there, General Kenobi. Hello there, Mr. Anderson';
    $madeMutator        = Trim::make(StringDirection::Both);
    $constructedMutator = Trim::make(StringDirection::Both);

    expect($madeMutator->mutate($input))->toBe($constructedMutator->mutate($input));
});

test('trims all supported characters', function (string $characters) {
    $input = $characters . 'foo' . $characters;

    $mutator = Trim::make(StringDirection::Both);

    expect($mutator->mutate($input))->toBe('foo');
})->with(function () {
    $characters = " \t\n\r\0\x0B";

    return [
        'space'           => ' ',
        'tab'             => "\t",
        'newline'         => "\n",
        'carriage return' => "\r",
        'null'            => "\0",
        'vertical tab'    => "\x0B",
        'trim fn default' => $characters,
    ];
});

test('trims specified characters', function () {
    $mutator = Trim::make(StringDirection::Both, 'o');

    expect($mutator->mutate('foo'))->toBe('f');
});

test('alias matches direction', function (string $method, string $input, string $expected) {
    $mutator = Trim::$method();

    expect($mutator->mutate($input))->toBe($expected);
})->with([
    'Trim::both()' => [
        'method' => 'both',
        'input'  => ' foo ',
        'output' => 'foo',
    ],
    'Trim::left()' => [
        'method' => 'left',
        'input'  => ' foo ',
        'output' => 'foo ',
    ],
    'Trim::right()' => [
        'method' => 'right',
        'input'  => ' foo ',
        'output' => ' foo',
    ],
]);
