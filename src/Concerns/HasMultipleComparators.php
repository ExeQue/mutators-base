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

    /**
     * @param  callable|bool  ...$comparators A list of comparators to use
     */
    public function __construct(callable|bool ...$comparators)
    {
        Assert::notEmpty($comparators, 'Comparators must not be empty');

        $this->comparators = $this->resolveComparators($comparators);
    }

    /**
     * @param  callable|bool  ...$comparators A list of comparators to add
     */
    public function with(callable|bool ...$comparators): self
    {
        $this->comparators = array_merge($this->comparators, $this->resolveComparators($comparators));

        return $this;
    }

    /**
     * @param  callable|bool  ...$comparators A list of comparators to use
     */
    public static function make(callable|bool ...$comparators): self
    {
        return new self(...$comparators);
    }

    /**
     * @param  callable|bool  ...$comparators A list of comparators to use
     */
    public static function makeFromArray(array $comparators): self
    {
        return new self(...$comparators);
    }
}
