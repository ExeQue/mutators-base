<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\String;

use ExeQue\Remix\Exceptions\InvalidArgumentException;
use ExeQue\Remix\Mutate\String\Ucfirst;

it('converts the first character of a string to uppercase', function (mixed $input, mixed $expected) {
    $mutator = Ucfirst::make();

    expect($mutator->mutate($input))->toBe($expected);
})->with([
    'one word' => [
        'input'    => 'foo',
        'expected' => 'Foo'
    ],
    'multiple words' => [
        'input'    => 'foo bar baz',
        'expected' => 'Foo bar baz'
    ],
    'one multibyte word' => [
        'input'    => 'ægæg',
        'expected' => 'Ægæg'
    ],
    'multiple multibyte words' => [
        'input'    => 'ægæg øl øl',
        'expected' => 'Ægæg øl øl'
    ],
    'multiple words with leading whitespace' => [
        'input'    => ' foo bar baz',
        'expected' => ' foo bar baz'
    ],
    'multiple words with trailing whitespace' => [
        'input'    => 'foo bar baz ',
        'expected' => 'Foo bar baz '
    ],
    'multiple words with leading and trailing whitespace' => [
        'input'    => ' foo bar baz ',
        'expected' => ' foo bar baz '
    ],
    'multiple words with leading and trailing whitespace and newlines' => [
        'input'    => " \nfoo bar baz \n",
        'expected' => " \nfoo bar baz \n"
    ],
    'using stringable input' => [
        'input' => new class () {
            public function __toString(): string
            {
                return 'foo';
            }
        },
        'expected' => 'Foo'
    ],
]);

it('throws an exception when given an invalid encoding', function () {
    $mutator = Ucfirst::make('invalid');

    $mutator->mutate('foo');
})->throws(InvalidArgumentException::class);

it('throws an exception when given a non-stringable input', function () {
    $mutator = Ucfirst::make();

    $mutator->mutate([]);
})->throws(InvalidArgumentException::class);
