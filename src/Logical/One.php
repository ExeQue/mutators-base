<?php

declare(strict_types=1);

namespace ExeQue\Mutators\Logical;

use ExeQue\Mutators\Comparator;
use ExeQue\Mutators\Concerns\HasMultipleComparators;

/**
 * Only one of the given comparators must be true. Outputs false if none or more than one is true (xor).
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class One extends Comparator
{
    use HasMultipleComparators;

    protected function compare(mixed $value): bool
    {
        $true = false;

        foreach ($this->comparators as $comparator) {
            if ($comparator->mutate($value)) {
                if ($true) {
                    return false;
                }

                $true = true;
            }
        }

        return $true;
    }
}
