<?php

declare(strict_types=1);

namespace ExeQue\Mutators\Concerns;

use ExeQue\Mutators\Assert;

trait HasMultipleComparators
{
    use ResolvesComparators;

    private array $comparators;

    public function __construct(callable|bool ...$comparators)
    {
        Assert::notEmpty($comparators, 'Comparators must not be empty');

        $this->comparators = $this->resolveComparators($comparators);
    }

    public static function make(callable|bool ...$comparators): self
    {
        return new self(...$comparators);
    }

    public static function makeFromArray(array $comparators): self
    {
        return new self(...$comparators);
    }
}
