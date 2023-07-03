<?php

declare(strict_types=1);

namespace ExeQue\Mutators\Concerns;

use ExeQue\Mutators\CallbackComparator;
use ExeQue\Mutators\ComparatorInterface;
use ExeQue\Mutators\Exceptions\InvalidComparatorException;
use ExeQue\Mutators\Logical\All;
use ExeQue\Mutators\MutatorInterface;

trait ResolvesComparators
{
    protected function resolveComparator(mixed $comparator): MutatorInterface
    {
        if (is_bool($comparator)) {
            $comparator = static fn () => $comparator;
        }

        if ($comparator instanceof ComparatorInterface) {
            return $comparator;
        }

        if (! is_string($comparator) && is_callable($comparator)) {
            return new CallbackComparator($comparator);
        }

        if (is_array($comparator)) {
            return new All(...$comparator);
        }

        throw new InvalidComparatorException(sprintf(
            'Invalid comparator - must be a non-string callable, array or instance of MutatorInterface. Got: %s',
            get_debug_type($comparator)
        ));
    }

    protected function resolveComparators(array $comparators): array
    {
        return array_map(fn ($comparators) => $this->resolveComparator($comparators), $comparators);
    }
}
