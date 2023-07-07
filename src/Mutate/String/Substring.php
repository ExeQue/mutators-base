<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\String;

use ExeQue\Remix\Concerns\Definitions\UsesEncoding;

/**
 * Extracts a substring from a string
 *
 * @see mb_substr()
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Substring extends StringMutator
{
    use UsesEncoding;

    protected int $start;
    protected ?int $length;

    /**
     * @param  int  $start The position to start extraction from.
     * @param  int|null  $length The number of characters to extract (optional).
     * @param  string|null  $encoding The encoding to use (optional).
     */
    public function __construct(int $start, int $length = null, string $encoding = null)
    {
        $this->start  = $start;
        $this->length = $length;

        $this->setEncoding($encoding);
    }

    /**
     * @param  int  $start The position to start extraction from.
     * @param  int|null  $length The number of characters to extract (optional).
     * @param  string|null  $encoding The encoding to use (optional).
     */
    public static function make(int $start, int $length = null, string $encoding = null): self
    {
        return new self($start, $length, $encoding);
    }

    protected function mutateString(string $value): string
    {
        return mb_substr($value, $this->start, $this->length, $this->getEncoding($value));
    }
}
