<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\Number\Math;

use ExeQue\Remix\Mutate\Number\NumberMutator;

/**
 * Calculate the root of a number.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Root extends NumberMutator
{
    private int|float $root;

    /**
     * @param float|int $root The root to calculate.
     */
    public function __construct(float|int $root)
    {
        $this->root = $root;
    }

    /**
     * @param float|int $root The root to calculate.
     */
    public static function make(float|int $root): self
    {
        return new self($root);
    }

    public static function square(): Root
    {
        return self::make(2);
    }

    public static function cube(): Root
    {
        return self::make(3);
    }

    protected function mutateNumber(float|int $value): float|int
    {
        return $value ** (1 / $this->root);
    }
}
