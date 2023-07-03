<?php

declare(strict_types=1);

namespace ExeQue\Remix\Concerns;

use ExeQue\Remix\Assert;
use ExeQue\Remix\Compare\ComparatorInterface;

trait HasMultipleComparators
{
    use ResolvesComparators;

    /** @var ComparatorInterface[] */
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
