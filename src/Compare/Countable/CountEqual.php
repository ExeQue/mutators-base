<?php

declare(strict_types=1);

namespace ExeQue\Remix\Compare\Countable;

use ExeQue\Remix\Assert;
use ExeQue\Remix\Compare\ComparatorInterface;
use ExeQue\Remix\Compare\Same;

/**
 * Checks if the count of a value is equal to a given size.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class CountEqual extends CountableComparator
{
    private ComparatorInterface $comparator;

    /**
     * @param  int  $size Size to compare to
     */
    public function __construct(int $size)
    {
        Assert::greaterThanEq($size, 0, 'Size must be greater than or equal to %2$s. Got: %s');

        $this->comparator = Same::make($size);
    }

    /**
     * @param  int  $size Size to compare to
     */
    public static function make(int $size): self
    {
        return new self($size);
    }

    protected function checkCount(int $count): bool
    {
        return $this->comparator->check($count);
    }
}
