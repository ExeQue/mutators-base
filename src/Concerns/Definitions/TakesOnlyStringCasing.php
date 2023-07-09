<?php

declare(strict_types=1);

namespace ExeQue\Remix\Concerns\Definitions;

use ExeQue\Remix\Data\StringCase;

trait TakesOnlyStringCasing
{
    protected StringCase $casing;

    /**
     * @param StringCase|string $casing The casing to use
     */
    public function __construct(StringCase|string $casing)
    {
        $this->casing = StringCase::from($casing);
    }

    /**
     * @param StringCase|string $casing The casing to use
     */
    public static function make(StringCase|string $casing): self
    {
        return new self($casing);
    }

    /**
     * Use the Ada casing.
     */
    public static function ada(): self
    {
        return new self(StringCase::Ada);
    }

    /**
     * Use the Camel casing.
     */
    public static function camel(): self
    {
        return new self(StringCase::Camel);
    }

    /**
     * Use the Cobol casing.
     */
    public static function cobol(): self
    {
        return new self(StringCase::Cobol);
    }

    /**
     * Use the Dot casing.
     */
    public static function dot(): self
    {
        return new self(StringCase::Dot);
    }

    /**
     * Use the Kebab casing.
     */
    public static function kebab(): self
    {
        return new self(StringCase::Kebab);
    }

    /**
     * Use the Lower casing.
     */
    public static function lower(): self
    {
        return new self(StringCase::Lower);
    }

    /**
     * Use the Macro casing.
     */
    public static function macro(): self
    {
        return new self(StringCase::Macro);
    }

    /**
     * Use the Pascal casing.
     */
    public static function pascal(): self
    {
        return new self(StringCase::Pascal);
    }

    /**
     * Use the Sentence casing.
     */
    public static function sentence(): self
    {
        return new self(StringCase::Sentence);
    }

    /**
     * Use the Snake casing.
     */
    public static function snake(): self
    {
        return new self(StringCase::Snake);
    }

    /**
     * Use the Title casing.
     */
    public static function title(): self
    {
        return new self(StringCase::Title);
    }

    /**
     * Use the Train casing.
     */
    public static function train(): self
    {
        return new self(StringCase::Train);
    }

    /**
     * Use the Upper casing.
     */
    public static function upper(): self
    {
        return new self(StringCase::Upper);
    }
}
