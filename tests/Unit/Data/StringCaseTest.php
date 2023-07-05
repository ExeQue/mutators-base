<?php

declare(strict_types=1);

namespace Tests\Unit\Data;

use ExeQue\Remix\Data\StringCase;
use ExeQue\Remix\Exceptions\InvalidArgumentException;

it('fetches casing from string input', function (string $caseAlias) {
    StringCase::from($caseAlias);
})->throwsNoExceptions()->with([
    'camel'    => 'camel',
    'pascal'   => 'pascal',
    'snake'    => 'snake',
    'ada'      => 'ada',
    'macro'    => 'macro',
    'kebab'    => 'kebab',
    'train'    => 'train',
    'cobol'    => 'cobol',
    'lower'    => 'lower',
    'upper'    => 'upper',
    'title'    => 'title',
    'sentence' => 'sentence',
    'dot'      => 'dot',
    'CAMEL'    => 'CAMEL',
    'PASCAL'   => 'PASCAL',
    'SNAKE'    => 'SNAKE',
    'ADA'      => 'ADA',
    'MACRO'    => 'MACRO',
    'KEBAB'    => 'KEBAB',
    'TRAIN'    => 'TRAIN',
    'COBOL'    => 'COBOL',
    'LOWER'    => 'LOWER',
    'UPPER'    => 'UPPER',
    'TITLE'    => 'TITLE',
    'SENTENCE' => 'SENTENCE',
    'DOT'      => 'DOT',
]);

it('fails when fetching casing from invalid string input', function () {
    StringCase::from('foobar');
})->throws(InvalidArgumentException::class);
