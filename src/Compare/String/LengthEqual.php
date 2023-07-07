<?php

declare(strict_types=1);

namespace ExeQue\Remix\Compare\String;

use ExeQue\Remix\Assert;
use ExeQue\Remix\Compare\ComparatorInterface;
use ExeQue\Remix\Compare\Same;

/**
 * Checks if the length of a string is equal to a given length.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class LengthEqual extends LengthComparator
{
    private ComparatorInterface $comparator;

    /**
     * @param int $length Length to compare to
     */
    public function __construct(int $length)
    {
        Assert::greaterThanEq($length, 0, 'Length must be greater than or equal to %2$s. Got: %s');

        $this->comparator = Same::make($length);
    }

    /**
     * @param int $length Length to compare to
     */
    public static function make(int $length): self
    {
        return new self($length);
    }

    protected function compareLength(int $length): bool
    {
        return $this->comparator->check($length);
    }
}
