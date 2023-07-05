<?php

declare(strict_types=1);

namespace ExeQue\Remix\Compare\Format;

use DateTime;
use ExeQue\Remix\Compare\String\StringComparator;

/**
 * Checks if a string is a valid datetime in the given format.
 *
 * @see https://www.php.net/manual/en/datetime.format.php#refsect1-datetime.format-parameters
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class IsDateTimeFormat extends StringComparator
{
    private string $format;

    public function __construct(string $format)
    {
        $this->format = $format;
    }

    public static function make(string $format): self
    {
        return new self($format);
    }

    protected function checkString(string $value): bool
    {
        $date = DateTime::createFromFormat($this->format, $value);

        return $date !== false && $date->format($this->format) === $value;
    }
}
