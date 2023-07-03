<?php

declare(strict_types=1);

namespace Tests\Unit\Concerns;

use ExeQue\Remix\Data\StringCase;
use Tests\Fixtures\TakesOnlyStringCasingFixture as Fixture;

test('uses correct casing', function (Fixture $alias, StringCase $case) {
    expect($alias->get())->toBe($case);
})->with([
    'ada'      => fn () => [Fixture::ada(), StringCase::Ada],
    'camel'    => fn () => [Fixture::camel(), StringCase::Camel],
    'cobol'    => fn () => [Fixture::cobol(), StringCase::Cobol],
    'dot'      => fn () => [Fixture::dot(), StringCase::Dot],
    'kebab'    => fn () => [Fixture::kebab(), StringCase::Kebab],
    'lower'    => fn () => [Fixture::lower(), StringCase::Lower],
    'macro'    => fn () => [Fixture::macro(), StringCase::Macro],
    'pascal'   => fn () => [Fixture::pascal(), StringCase::Pascal],
    'sentence' => fn () => [Fixture::sentence(), StringCase::Sentence],
    'snake'    => fn () => [Fixture::snake(), StringCase::Snake],
    'title'    => fn () => [Fixture::title(), StringCase::Title],
    'train'    => fn () => [Fixture::train(), StringCase::Train],
    'upper'    => fn () => [Fixture::upper(), StringCase::Upper],
]);
