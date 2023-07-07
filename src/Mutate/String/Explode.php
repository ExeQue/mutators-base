<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\String;

use ExeQue\Remix\Assert;
use ExeQue\Remix\Mutate\Mutator;

/**
 * Explode a string into an array
 *
 * @see explode()
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Explode extends Mutator
{
    private string $delimiter;
    private int $limit;

    /**
     * @param  string  $delimiter The boundary string.
     * @param  int  $limit The maximum number of elements to return (optional).
     */
    public function __construct(string $delimiter, int $limit = PHP_INT_MAX)
    {
        Assert::greaterThanEq($limit, 1, 'Limit must be greater than or equal to 1');

        $this->delimiter = $delimiter;
        $this->limit     = $limit;
    }

    /**
     * @param  string  $delimiter The boundary string.
     * @param  int  $limit The maximum number of elements to return (optional).
     */
    public static function make(string $delimiter, int $limit = PHP_INT_MAX): self
    {
        return new self($delimiter, $limit);
    }

    public function mutate(mixed $value): array
    {
        return explode($this->delimiter, $value, $this->limit);
    }
}
