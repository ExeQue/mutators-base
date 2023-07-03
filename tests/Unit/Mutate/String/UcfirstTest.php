<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\String;

use ExeQue\Remix\Mutate\String\Ucfirst;

test('converts the first character of a string to uppercase', function (string $input, string $expected) {
    $mutator = Ucfirst::make();

    expect($mutator->mutate($input))->toBe($expected);
})->with([
    ['foo', 'Foo'],
    ['foo foo', 'Foo foo'],
    ['FOO', 'FOO'],
    ['fOO', 'FOO'],
    ['æøå', 'Æøå'],
    ['æøå üïë', 'Æøå üïë'],
]);
