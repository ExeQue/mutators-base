<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\String;

use ExeQue\Remix\Concerns\Definitions\TakesOnlyStringCasing;
use ExeQue\Remix\Data\StringCase;
use Jawira\CaseConverter\Convert;

/**
 * Converts string between different casing types.
 *
 * Based on `jawira/case-converter`.
 *
 * @see Convert
 * @see https://github.com/jawira/case-converter
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Casing extends StringMutator
{
    use TakesOnlyStringCasing;

    protected function mutateString(string $value): string
    {
        $convert = new Convert($value);

        return match ($this->casing) {
            StringCase::Camel    => $convert->toCamel(),
            StringCase::Pascal   => $convert->toPascal(),
            StringCase::Snake    => $convert->toSnake(),
            StringCase::Ada      => $convert->toAda(),
            StringCase::Macro    => $convert->toMacro(),
            StringCase::Kebab    => $convert->toKebab(),
            StringCase::Train    => $convert->toTrain(),
            StringCase::Cobol    => $convert->toCobol(),
            StringCase::Lower    => mb_strtolower($value),
            StringCase::Upper    => mb_strtoupper($value),
            StringCase::Title    => $convert->toTitle(),
            StringCase::Sentence => $convert->toSentence(),
            StringCase::Dot      => $convert->toDot(),
        };
    }
}
