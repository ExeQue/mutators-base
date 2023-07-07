<?php

declare(strict_types=1);

namespace ExeQue\Remix\Concerns\Definitions;

use ExeQue\Remix\Data\StringCase;

trait TakesOnlyStringCasing
{
    protected StringCase $casing;

    /**
     * @param  StringCase|string  $casing The casing to use
     */
    public function __construct(StringCase|string $casing)
    {
        $this->casing = StringCase::from($casing);
    }

    /**
     * @param  StringCase|string  $casing The casing to use
     */
    public static function make(StringCase|string $casing): self
    {
        return new self($casing);
    }

    public static function ada(): self
    {
        return new self(StringCase::Ada);
    }

    public static function camel(): self
    {
        return new self(StringCase::Camel);
    }

    public static function cobol(): self
    {
        return new self(StringCase::Cobol);
    }

    public static function dot(): self
    {
        return new self(StringCase::Dot);
    }

    public static function kebab(): self
    {
        return new self(StringCase::Kebab);
    }

    public static function lower(): self
    {
        return new self(StringCase::Lower);
    }

    public static function macro(): self
    {
        return new self(StringCase::Macro);
    }

    public static function pascal(): self
    {
        return new self(StringCase::Pascal);
    }

    public static function sentence(): self
    {
        return new self(StringCase::Sentence);
    }

    public static function snake(): self
    {
        return new self(StringCase::Snake);
    }

    public static function title(): self
    {
        return new self(StringCase::Title);
    }

    public static function train(): self
    {
        return new self(StringCase::Train);
    }

    public static function upper(): self
    {
        return new self(StringCase::Upper);
    }
}
