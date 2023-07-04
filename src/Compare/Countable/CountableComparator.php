<?php

declare(strict_types=1);

namespace ExeQue\Remix\Compare\Countable;

use ExeQue\Remix\Assert;
use ExeQue\Remix\Compare\Comparator;

abstract class CountableComparator extends Comparator
{
    final public function check(mixed $value): bool
    {
        if (is_countable($value)) {
            return $this->checkCount(count($value));
        }

        if ($this->objectHasCountMethod($value)) {
            return $this->checkCount($value->count());
        }

        Assert::report(static::class . ' can only compare countable values. Got: %s', $value);
    }

    abstract protected function checkCount(int $count): bool;

    private function objectHasCountMethod(mixed $value): bool
    {
        return is_object($value) && method_exists($value, 'count');
    }
}
