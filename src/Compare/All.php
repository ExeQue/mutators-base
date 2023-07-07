<?php

declare(strict_types=1);

namespace ExeQue\Remix\Compare;

use ExeQue\Remix\Concerns\HasMultipleComparators;

/**
 * Requires the output of every comparator to be true.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class All extends Comparator
{
    use HasMultipleComparators;

    public function check(mixed $value): bool
    {
        foreach ($this->comparators as $comparator) {
            if (! $comparator->check($value)) {
                return false;
            }
        }

        return true;
    }
}
