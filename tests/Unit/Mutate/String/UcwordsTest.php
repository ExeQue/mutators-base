<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\String;

use ExeQue\Remix\Mutate\String\Ucwords;

it('converts the first character of each word in a string to uppercase', function (mixed $input, mixed $expected) {
    $mutator = Ucwords::make();

    expect($mutator->mutate($input))->toBe($expected);
})->with([
    'one word' => [
        'input'    => 'foo',
        'expected' => 'Foo'
    ],
    'multiple words' => [
        'input'    => 'foo bar baz',
        'expected' => 'Foo Bar Baz'
    ],
    'one multibyte word' => [
        'input'    => 'ægæg',
        'expected' => 'Ægæg'
    ],
    'multiple multibyte words' => [
        'input'    => 'ægæg øl øl',
        'expected' => 'Ægæg Øl Øl'
    ],
    'multiple words with leading whitespace' => [
        'input'    => ' foo bar baz',
        'expected' => ' Foo Bar Baz'
    ],
    'multiple words with trailing whitespace' => [
        'input'    => 'foo bar baz ',
        'expected' => 'Foo Bar Baz '
    ],
    'multiple words with leading and trailing whitespace' => [
        'input'    => ' foo bar baz ',
        'expected' => ' Foo Bar Baz '
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
