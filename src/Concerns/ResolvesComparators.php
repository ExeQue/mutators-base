<?php

declare(strict_types=1);

namespace ExeQue\Remix\Concerns;

use ExeQue\Remix\Compare\All;
use ExeQue\Remix\Compare\ComparatorInterface;
use ExeQue\Remix\Compare\ComparesUsing;
use ExeQue\Remix\Exceptions\InvalidComparatorException;

trait ResolvesComparators
{
    protected function resolveComparator(mixed $comparator): ComparatorInterface
    {
        if (is_bool($comparator)) {
            $comparator = static fn () => $comparator;
        }

        if ($comparator instanceof ComparatorInterface) {
            return $comparator;
        }

        if (! is_string($comparator) && is_callable($comparator)) {
            return ComparesUsing::make($comparator);
        }

        if (is_array($comparator)) {
            return new All(...$comparator);
        }

        throw new InvalidComparatorException(sprintf(
            'Invalid comparator - must be a non-string callable, array or instance of ComparatorInterface. Got: %s',
            get_debug_type($comparator)
        ));
    }

    protected function resolveComparators(array $comparators): array
    {
        return array_map(fn ($comparators) => $this->resolveComparator($comparators), $comparators);
    }
}
