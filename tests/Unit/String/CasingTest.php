<?php

declare(strict_types=1);

namespace Tests\Unit\String;

use ExeQue\Mutators\Data\StringCase;
use ExeQue\Mutators\String\Casing;
use function Pest\Faker\fake;

test('covers casing', function (StringCase $casing) {
    $mutator = Casing::make($casing);

    $mutator->mutate('foo');
})->with(StringCase::cases())->throwsNoExceptions();

test('alias uses correct casing', function (Casing $alias, StringCase $case) {
    $sentence = fake()->sentence();

    $mutator = new Casing($case);

    expect($mutator->mutate($sentence))->toEqual($alias->mutate($sentence));
})->with([
    'ada'      => fn () => [Casing::ada(), StringCase::Ada],
    'camel'    => fn () => [Casing::camel(), StringCase::Camel],
    'cobol'    => fn () => [Casing::cobol(), StringCase::Cobol],
    'dot'      => fn () => [Casing::dot(), StringCase::Dot],
    'kebab'    => fn () => [Casing::kebab(), StringCase::Kebab],
    'lower'    => fn () => [Casing::lower(), StringCase::Lower],
    'macro'    => fn () => [Casing::macro(), StringCase::Macro],
    'pascal'   => fn () => [Casing::pascal(), StringCase::Pascal],
    'sentence' => fn () => [Casing::sentence(), StringCase::Sentence],
    'snake'    => fn () => [Casing::snake(), StringCase::Snake],
    'title'    => fn () => [Casing::title(), StringCase::Title],
    'train'    => fn () => [Casing::train(), StringCase::Train],
    'upper'    => fn () => [Casing::upper(), StringCase::Upper],
]);
