<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\Array;

use ExeQue\Remix\Assert;
use ExeQue\Remix\Mutate\Mutator;

/**
 * Implode an array or iterable value.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Implode extends Mutator
{
    private string $glue;
    private ?string $finalGlue;

    /**
     * @param string $glue The glue to use between values (default: "").
     * @param string|null $finalGlue The glue to use between the last two values (optional).
     */
    public function __construct(string $glue = '', string $finalGlue = null)
    {
        $this->glue      = $glue;
        $this->finalGlue = $finalGlue;
    }

    /**
     * @param string $glue The glue to use between values (default: "").
     * @param string|null $finalGlue The glue to use between the last two values (optional).
     */
    public static function make(string $glue = '', string $finalGlue = null): self
    {
        return new self($glue, $finalGlue);
    }

    public function mutate(mixed $value): mixed
    {
        Assert::isIterable($value, static::class . ' expects an iterable value');

        if (! is_array($value)) {
            $value = iterator_to_array($value);
        }

        if (count($value) === 1) {
            return array_pop($value);
        }

        if ($this->finalGlue === null) {
            return implode($this->glue, $value);
        }

        $last = array_pop($value);

        return implode($this->finalGlue, [implode($this->glue, $value), $last]);
    }
}
