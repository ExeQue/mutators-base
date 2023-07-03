<?php

declare(strict_types=1);

namespace ExeQue\Mutators\Logical;

use ExeQue\Mutators\Comparator;
use ExeQue\Mutators\Concerns\HasMultipleComparators;

/**
 * Requires the output of at least one comparator to be true.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Any extends Comparator
{
    use HasMultipleComparators;

    protected function compare(mixed $value): bool
    {
        foreach ($this->comparators as $comparator) {
            if ($comparator->mutate($value)) {
                return true;
            }
        }

        return false;
    }
}
