<?php

declare(strict_types=1);

namespace ExeQue\Remix\Compare\Array;

/**
 * Checks if a key exists in an array.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class KeyExists extends ArrayComparator
{
    private string|int $key;

    public function __construct(int|string $key)
    {
        $this->key = $key;
    }

    public static function make(int|string $key): self
    {
        return new self($key);
    }

    protected function checkArray(array $value): bool
    {
        return array_key_exists($this->key, $value);
    }
}
