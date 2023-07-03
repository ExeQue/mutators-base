<?php

declare(strict_types=1);

namespace ExeQue\Remix\Compare\Logical;

use ExeQue\Remix\Compare\Comparator;
use ExeQue\Remix\Concerns\HasMultipleComparators;

/**
 * Only one of the given comparators must be true. Outputs false if none or more than one is true (xor).
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class One extends Comparator
{
    use HasMultipleComparators;

    public function check(mixed $value): bool
    {
        $true = false;

        foreach ($this->comparators as $comparator) {
            if ($comparator->check($value)) {
                if ($true) {
                    return false;
                }

                $true = true;
            }
        }

        return $true;
    }
}
