<?php

declare(strict_types=1);

namespace ExeQue\Mutators\String;

use ExeQue\Mutators\Assert;
use ExeQue\Mutators\Concerns\Definitions\UsesEncoding;
use ExeQue\Mutators\Mutator;

/**
 * Chunk a string into an array of strings with a specified max size.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Chunk extends Mutator
{
    use UsesEncoding;

    private int $size;

    public function __construct(int $size, string $encoding = null)
    {
        Assert::greaterThan($size, 0, 'Size must be greater than 0.');

        $this->size = $size;
        $this->setEncoding($encoding);
    }

    public static function make(int $size, string $encoding = null): self
    {
        return new self($size, $encoding);
    }

    public function mutate(mixed $value): array
    {
        Assert::string($value, 'Value must be a string.');

        return mb_str_split($value, $this->size, $this->getEncoding($value));
    }
}
