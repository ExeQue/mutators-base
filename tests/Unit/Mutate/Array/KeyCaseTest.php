<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\Array;

use ExeQue\Remix\Data\StringCase;
use ExeQue\Remix\Mutate\Array\KeyCase;

it('changes key casing of an array', function (StringCase $casing, array $input, array $expected) {
    $mutator = KeyCase::make($casing);

    expect($mutator->mutate($input))->toBe($expected);
})->with([
    'camelcase => snake_case' => [
        'casing' => StringCase::Snake,
        'input'  => [
            'fooBar' => 'baz',
            'barFoo' => 'baz',
        ],
        'expected' => [
            'foo_bar' => 'baz',
            'bar_foo' => 'baz',
        ],
    ],
    'snake_case => camelCase' => [
        'casing' => StringCase::Camel,
        'input'  => [
            'foo_bar' => 'baz',
            'bar_foo' => 'baz',
        ],
        'expected' => [
            'fooBar' => 'baz',
            'barFoo' => 'baz',
        ],
    ],
]);
