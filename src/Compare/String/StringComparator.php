<?php

declare(strict_types=1);

namespace ExeQue\Remix\Compare\String;

use ExeQue\Remix\Compare\Comparator;
use ExeQue\Remix\Concerns\ResolvesStringInput;

abstract class StringComparator extends Comparator
{
    use ResolvesStringInput;

    /**
     * Compare the input string against the comparator.
     */
    final public function check(mixed $value): bool
    {
        $value = $this->resolveStringInput($value);

        return $this->checkString($value);
    }

    /**
     * Compare the input string against the comparator.
     */
    abstract protected function checkString(string $value): bool;
}
