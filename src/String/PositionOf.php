<?php

declare(strict_types=1);

namespace ExeQue\Mutators\String;

use ExeQue\Mutators\Concerns\Definitions\UsesEncoding;
use ExeQue\Mutators\Mutator;

/**
 * Finds the position of the first occurrence of a substring in a string
 *
 * @see mb_strpos()
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class PositionOf extends Mutator
{
    use UsesEncoding;

    protected string $needle;
    protected int $offset = 0;

    public function __construct(string $needle, int $offset = 0, string $encoding = null)
    {
        $this->needle = $needle;
        $this->offset = $offset;

        $this->setEncoding($encoding);
    }

    public static function make(string $needle, int $offset = 0, string $encoding = null): self
    {
        return new self($needle, $offset, $encoding);
    }

    public function mutate(mixed $value): int|false
    {
        return mb_strpos($value, $this->needle, $this->offset, $this->getEncoding($value));
    }
}
