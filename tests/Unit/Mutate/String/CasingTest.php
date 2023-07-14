<?php

declare(strict_types=1);

namespace Tests\Unit\Mutate\String;

use ExeQue\Remix\Data\StringCase;
use ExeQue\Remix\Mutate\String\Casing;

it('covers casing', function (StringCase $casing) {
    $mutator = Casing::make($casing);

    $mutator->mutate('foo');
})->with(StringCase::cases())->throwsNoExceptions();

it('changes the casing of a string', function (StringCase $casing, string $expected, array $tests) {
    $mutator = Casing::make($casing);

    foreach ($tests as $test) {
        expect($mutator->mutate($test))->toBe($expected);
    }
})->with(function () {
    $cases = [
        'camel' => [
            'casing'   => StringCase::Camel,
            'expected' => 'fooBar',
        ],
        'pascal' => [
            'casing'   => StringCase::Pascal,
            'expected' => 'FooBar',
        ],
        'snake' => [
            'casing'   => StringCase::Snake,
            'expected' => 'foo_bar',
        ],
        'ada' => [
            'casing'   => StringCase::Ada,
            'expected' => 'Foo_Bar',
        ],
        'macro' => [
            'casing'   => StringCase::Macro,
            'expected' => 'FOO_BAR',
        ],
        'kebab' => [
            'casing'   => StringCase::Kebab,
            'expected' => 'foo-bar',
        ],
        'train' => [
            'casing'   => StringCase::Train,
            'expected' => 'Foo-Bar',
        ],
        'cobol' => [
            'casing'   => StringCase::Cobol,
            'expected' => 'FOO-BAR',
        ],
        'title' => [
            'casing'   => StringCase::Title,
            'expected' => 'Foo Bar',
        ],
        'sentence' => [
            'casing'   => StringCase::Sentence,
            'expected' => 'Foo bar',
        ],
        'dot' => [
            'casing'   => StringCase::Dot,
            'expected' => 'foo.bar',
        ],
    ];

    $testStrings = array_column($cases, 'expected');

    array_walk($cases, function (array &$case) use ($testStrings) {
        $case['tests'] = $testStrings;
    });

    return $cases;
});
