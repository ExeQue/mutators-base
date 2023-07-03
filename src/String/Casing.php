<?php

declare(strict_types=1);

namespace ExeQue\Mutators\String;

use ExeQue\Mutators\Data\StringCase;
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
    private StringCase $casing;

    public function __construct(StringCase $casing)
    {
        $this->casing = $casing;
    }

    public static function make(StringCase $casing): self
    {
        return new self($casing);
    }

    public static function ada(): Casing
    {
        return new self(StringCase::Ada);
    }

    public static function camel(): Casing
    {
        return new self(StringCase::Camel);
    }

    public static function cobol(): Casing
    {
        return new self(StringCase::Cobol);
    }

    public static function dot(): Casing
    {
        return new self(StringCase::Dot);
    }

    public static function kebab(): Casing
    {
        return new self(StringCase::Kebab);
    }

    public static function lower(): Casing
    {
        return new self(StringCase::Lower);
    }

    public static function macro(): Casing
    {
        return new self(StringCase::Macro);
    }

    public static function pascal(): Casing
    {
        return new self(StringCase::Pascal);
    }

    public static function sentence(): Casing
    {
        return new self(StringCase::Sentence);
    }

    public static function snake(): Casing
    {
        return new self(StringCase::Snake);
    }

    public static function title(): Casing
    {
        return new self(StringCase::Title);
    }

    public static function train(): Casing
    {
        return new self(StringCase::Train);
    }

    public static function upper(): Casing
    {
        return new self(StringCase::Upper);
    }

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
            StringCase::Lower    => $convert->toLower(),
            StringCase::Upper    => $convert->toUpper(),
            StringCase::Title    => $convert->toTitle(),
            StringCase::Sentence => $convert->toSentence(),
            StringCase::Dot      => $convert->toDot(),
        };
    }
}
