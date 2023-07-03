<?php

declare(strict_types=1);

namespace Tests\Unit\String;

use ExeQue\Mutators\String\Ucwords;

test('converts the first character of each word in a string to uppercase', function (string $input, string $expected) {
    $mutator = Ucwords::make();

    expect($mutator->mutate($input))->toBe($expected);
})->with([
    ['foo', 'Foo'],
    ['foo foo', 'Foo Foo'],
    ['FOO', 'FOO'],
    ['fOO', 'FOO'],
    ['foo bar baz', 'Foo Bar Baz'],
    ['æøå', 'Æøå'],
    ['æøå üïë', 'Æøå Üïë'],
]);
